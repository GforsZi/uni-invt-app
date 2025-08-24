@php
    if ($data) {
        $totalPages = $data->lastPage()??'';
        $currentPage = $data->currentPage()??'';
        $start = max(1, $currentPage - 1);
        $end = min($totalPages, $currentPage + 2);
    } else {
        $totalPages = 0;
        $currentPage = 0;
        $start = max(1, $currentPage - 1);
        $end = min($totalPages, $currentPage + 2);
    }

@endphp

<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
    <div class="card-tools">
<ul class="pagination pagination-sm float-end">
    {{-- Tombol Previous --}}
    @if ($data)
        
    @if ($data->onFirstPage())
    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    @else
    <li class="page-item">
        <a class="page-link" href="{{ $data->url(1) }}{{ $query??'' }}" rel="prev">&laquo;</a>
    </li>
    @endif
    
    {{-- Tampilkan range halaman dinamis --}}
    @for ($i = $start; $i <= $end; $i++)
    @if ($i == $currentPage)
    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
    @else
    <li class="page-item"><a class="page-link" href="{{ $data->url($i) }}{{ $query??'' }}">{{ $i }}</a></li>
    @endif
    @endfor
    
    
    {{-- Tombol Next --}}
    @if ($data->hasMorePages())
    <li class="page-item">
        <a class="page-link" href="{{ $data->url($totalPages) }}{{ $query??'' }}" rel="next">&raquo;</a>
    </li>
    @else
    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @endif
    @else
    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
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
<ul class="pagination pagination-sm float-end">
    {{-- Tombol Previous --}}
    @if ($data)
        
    @if ($data->onFirstPage())
    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    @else
    <li class="page-item">
        <a class="page-link" href="{{ $data->url(1) }}{{ $query??'' }}" rel="prev">&laquo;</a>
    </li>
    @endif
    
    @for ($i = $start; $i <= $end; $i++)
    @if ($i == $currentPage)
    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
    @else
    <li class="page-item"><a class="page-link" href="{{ $data->url($i) }}{{ $query??'' }}">{{ $i }}</a></li>
    @endif
    @endfor
    
    
    {{-- Tombol Next --}}
    @if ($data->hasMorePages())
    <li class="page-item">
        <a class="page-link" href="{{ $data->url($totalPages) }}{{ $query??'' }}" rel="next">&raquo;</a>
    </li>
    @else
    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @endif
    @else
    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @endif
</ul>
  </div>
</div>

