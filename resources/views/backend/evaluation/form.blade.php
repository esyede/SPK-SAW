<form role="form" action="{{ url('evaluation/evaluate/update', $evaluate->id) }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="formGroupExampleInput">Kriteria</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="criteria_name" value="{{ $evaluate->criteria->criteria_name }}" readonly>
    <input type="hidden" class="form-control" id="formGroupExampleInput" name="criteria_id" value="{{ $evaluate->criteria->id }}" readonly>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Sub Kriteria</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" value="{{ $evaluate->subcriteria->name }}" readonly>
  </div>
  <input type="hidden" name="user_id" value="{{ $evaluate->user_id }}">
  <div class="form-group">
    <label for="formGroupExampleInput2">Nilai Atribut</label>
    <select class="form-control required fetch-info" name="attribute_value">
        @foreach(range(1, 5) as $v)
        <option value="{{ $v }}">{{ $v }}</option>
        @endforeach
    </select>
  </div>
  <div class="text-center pt-3">
    <button type="submit" class="btn btn-info ml-2">
        <i class="fas fa-plus-circle"></i> Simpan
    </button>
  </div>
</form>
