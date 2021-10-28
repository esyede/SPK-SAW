<form role="form" action="{{ url('evaluation/evaluate/update', $evaluate->id) }}" method="POST">
  @csrf
  <input type="hidden" value="{{$evaluate->users->id}}" name="user_id">
  <div class="form-group">
    <label for="formGroupExampleInput">Kriteria</label>
    <input type="text" class="form-control" id="formGroupExampleInput" value="{{ $evaluate->criteria->criteria_name }}" disabled>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Sub Kriteria</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" value="{{ $evaluate->subcriteria->name }}" disabled>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Nilai Atribut</label>
    <select class="form-control required fetch-info" name="attribute_value">
        @foreach(range(1, 5) as $v)
        <option value="{{ $v }}">{{ $v }}</option>
        @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-info ml-2">
      <i class="fas fa-plus-circle"></i> Simpan
  </button>
</form>
