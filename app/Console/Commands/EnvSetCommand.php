<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use InvalidArgumentException;

class EnvSetCommand extends Command
{
    public const COMMAND_NAME = 'env:set';
    public const ARGUMENT_KEY = 'key';
    public const ARGUMENT_VALUE = 'value';
    public const ARGUMENT_ENV_FILE = 'env_file';

    protected $signature = self::COMMAND_NAME
        . ' {' . self::ARGUMENT_KEY . ' : Key or "key=value" pair}'
        . ' {' . self::ARGUMENT_VALUE . '? : Value}'
        . ' {' . self::ARGUMENT_ENV_FILE . '? : Optional path to the .env file}';

    protected $description = 'Set and save an environment variable in the .env file';

    public function handle()
    {
        try {
            [$key, $value, $envFilePath] = $this->parseCommandArguments(
                $this->argument(self::ARGUMENT_KEY),
                $this->argument(self::ARGUMENT_VALUE),
                $this->argument(self::ARGUMENT_ENV_FILE)
            );

            $envFilePath = $envFilePath ? $envFilePath : App::environmentFilePath();
            $this->info("The following environment file is used: '" . $envFilePath . "'");
        } catch (InvalidArgumentException $e) {
            $this->error($e->getMessage());
            return;
        }

        $content = file_get_contents($envFilePath);
        [$newEnvFileContent, $isNewVariableSet] = $this->setEnvVariable($content, $key, $value);

        if ($isNewVariableSet) {
            $this->info("A new environment variable with key '{$key}' has been set to '{$value}'");
        } else {
            [$_, $oldValue] = explode('=', $this->readKeyValuePair($content, $key), 2);
            $this->info("Environment variable with key '{$key}' has been changed from '{$oldValue}' to '{$value}'");
        }

        $this->writeFile($envFilePath, $newEnvFileContent);
    }

    public function setEnvVariable(string $envFileContent, string $key, string $value): array
    {
        $oldPair = $this->readKeyValuePair($envFileContent, $key);

        if (preg_match('/\s/',$value) || strpos($value, '=') !== false) {
            $value = '"' . $value . '"';
        }

        $newPair = $key . '=' . $value;

        if ($oldPair !== null) {
            $replaced = preg_replace('/^' . preg_quote($oldPair, '/') . '$/uimU', $newPair, $envFileContent);
            return [$replaced, false];
        }

        return [$envFileContent . "\n" . $newPair . "\n", true];
    }

    public function readKeyValuePair(string $envFileContent, string $key)
    {
        if (preg_match('#^' . $key . '=*[^\R]*$#uimU', $envFileContent, $matches)) {
            return $matches[0];
        }

        return null;
    }

    public function parseCommandArguments(string $_key, ?string $_value, ?string $_envFilePath): array
    {
        $key = null;
        $value = null;
        $envFilePath = null;

        if (preg_match('#^([^=]+)=(.*)$#umU', $_key, $matches)) {
            [1 => $key, 2 => $value] = $matches;

            if ($_value !== null) {
                $envFilePath = $_value;
            }
        } else {
            $key = $_key;
            $value = $_value;
        }

        if ($envFilePath === null) {
            $envFilePath = $_envFilePath;
        }

        $this->assertKeyIsValid($key);

        if (preg_match('#^[^\'"].*\s+.*[^\'"]$#umU', $value)) {
            $value = '"' . $value . '"';
        }

        return [strtoupper($key), $value, (($envFilePath === null) ? null : realpath($envFilePath))];
    }

    public function assertKeyIsValid(string $key): bool
    {
        if (Str::contains($key, '=')) {
            throw new InvalidArgumentException('Invalid environment key ' . $key
                . "! Environment key should not contain '='");
        }

        if (!preg_match('/^[a-zA-Z_]+$/', $key)) {
            throw new InvalidArgumentException('Invalid environment key ' . $key
                . '! Only use letters and underscores');
        }

        return true;
    }

    protected function writeFile(string $path, string $contents): bool
    {
        return (bool) file_put_contents($path, $contents, LOCK_EX);
    }
}
