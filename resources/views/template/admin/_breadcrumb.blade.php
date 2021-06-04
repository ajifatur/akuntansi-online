<div class="app-title d-none">
  <div>
    <h1>{{ $breadcrumb['title'] }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    @foreach($breadcrumb['items'] as $key=>$item)
      @if($key == (count($breadcrumb['items']) - 1))
      <li class="breadcrumb-item active" aria-current="page">{{ $item['text'] }}</li>
      @else
      <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
      @endif
    @endforeach
  </ul>
</div>