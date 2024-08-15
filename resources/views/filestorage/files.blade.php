<form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Choose file</label>
        <input
            type="file"
            class="form-control"
            name="file"
            aria-describedby="fileHelpId"
        />
        <div id="fileHelpId" class="form-text">Help text</div>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input
            type="text"
            class="form-control"
            name="name"
            aria-describedby="helpId"
        />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</form>
