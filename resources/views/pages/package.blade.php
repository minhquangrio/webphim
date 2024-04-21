{{-- TRANG PACKAGE CỦA WEBSITE XEM PHIM --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--Section: Content-->
<section class="text-center">
  <h4 class="mb-4"><strong>THÔNG TIN CHI TIẾT GÓI</strong></h4>
  <span><a href="{{URL::to('/')}}">QUAY LẠI TRANG CHỦ</a></span>
  {{-- <div class="btn-group mb-4" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary active" >Monthly billing</button>
    <button type="button" class="btn btn-warning" >
      Annual billing <small>(2 months FREE)</small>
    </button>
  </div> --}}

  <div class="row gx-lg-5 center d-flex justify-content-center">

    @if(session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
    @elseif(session('error'))
      <div class="alert alert-error">
        {{session('error')}}
      </div>
    @endif  
    
    <!--Grid column-->
    @foreach($package as $key => $pack)
    <div class="col-lg-3 col-md-6 mb-4">
      <!-- Thông tin từng gói -->
      <div class="card border border-primary">
        <div class="card-header bg-white py-3">
          <p class="text-uppercase small mb-2" name="pack_name"><strong>{{$pack->name}}</strong></p>
          <h5 class="mb-0" name="pack_price">{{number_format($pack->price)}}đ/tháng</h5>
        </div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item" name="pack_quality">
              @if($pack->quality==0)
                Quality up to 720p
              @elseif($pack->quality==1)
                Quality up to 4K
              @endif
            </li>
            <li class="list-group-item" name="pack_chat">
              @if($pack->chat==0)
                No support chat
              @elseif($pack->chat==1)
                Support chat
              @endif
            </li>
            <li class="list-group-item" name="pack_hotMovie">
              @if($pack->hotMovie==0)
                Không được xem trước phim HOT
              @elseif($pack->hotMovie==1)
                Được xem phim HOT trước khi công chiếu
              @endif
            </li>
            <li class="list-group-item" name="pack_bookmark">
              @if($pack->bookmark==0)
                Không được lưu phim yêu thích
              @elseif($pack->bookmark==1)
                Được lưu phim yêu thích để xem sau
              @endif
            </li>
          </ul>
        </div>

        <div class="card-footer bg-white py-3">
          @if($pack->price != 0)
            <form action="{{ route('check_out', ['id' => $pack->id]) }}" method="POST">
              @csrf
              @method('POST')
              <input type="hidden" name="pack_id" value="{{ $pack->id }}">

              <button type="submit" class="btn btn-danger btn-sm" name="submit">Mua gói này</button>
            </form>
          @elseif($pack->price == 0)
            <div><br></div>
          @endif
        </div>
        
      </div>
    </div>
    @endforeach
  </div>
</section>
<!--Section: Content-->
