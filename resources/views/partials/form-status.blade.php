
@if (session('message'))
<br>
  <div class="alert alert-{{ Session::get('status') }} alert-white rounded status-box alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;<span class="sr-only">Close</span></a>
    {{ session('message') }}
  </div>
@endif

@if (session('success'))
<br>
  <div class="alert alert-success alert-white rounded alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> 
    {{ session('success') }}
  </div>
@endif

@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
    <br>
        <div class="alert alert-danger alert-white rounded status-box alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;<span class="sr-only">Close</span></a>
            {{ session('message') }}
        </div>
    @endif
@endif

@if (session('error'))
<br>
  <div class="alert alert-danger alert-white rounded alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> 
    {{ session('error') }}
  </div>
@endif

@if (count($errors) > 0)
<br>
  <div class="alert alert-danger alert-white rounded alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="icon fa fa-warning fa-fw" aria-hidden="true"></i>
      <strong>Error with your input! </strong>
      @foreach ($errors->all() as $error)
        {{ $loop->first ? '' : '. ' }}{{ $error }}
      @endforeach
  </div>
@endif