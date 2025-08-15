<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
    <div class="card-tools">
      <ul class="pagination pagination-sm float-end">
    @if ($data === null)
    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @else
      @if ($data->onFirstPage())
      <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
      @else
      <li class="page-item">
        <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">&laquo;</a>
      </li>
      @endif
      
      @for ($i = 1; $i <= $data->lastPage(); $i++)
      @if ($i == $data->currentPage())
      <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
        @else
        <li class="page-item">
          <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
        </li>
        @endif
        @endfor
        
        @if ($data->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">&raquo;</a>
        </li>
        @else
        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
      @endif
      </ul>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0" style="overflow-x: auto; white-space: nowrap;">
  <table class="table" style="min-width: 200px;">
    <thead>
      <tr>
        {{ $header }}
      </tr>
    </thead>
    <tbody>
      {{ $slot }}
    </tbody>
  </table>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
  <ul class="pagination pagination-sm m-0 float-end">
    @if ($data === null)
    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @else
      @if ($data->onFirstPage())
      <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
      @else
      <li class="page-item">
        <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">&laquo;</a>
      </li>
      @endif
      
      @for ($i = 1; $i <= $data->lastPage(); $i++)
      @if ($i == $data->currentPage())
      <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
        @else
        <li class="page-item">
          <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
        </li>
        @endif
        @endfor
        
        @if ($data->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">&raquo;</a>
        </li>
        @else
        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
      @endif
    </ul>
  </div>
</div>

