@if($ac > 90)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Location not Accurate</strong> Please reload your browser or clik Get My Location Button.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif($ac <= 90)
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Location is accurate</strong> The map is ready
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(is_null($ac))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!!</strong> Geolocation is not supported by this browser. 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif