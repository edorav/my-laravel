<div class="card card-user" >
    <img class="card-img-top" src="{{ asset( 'img/iceland.jpg') }}" alt="Card image cap">
    <a href="#">
    <img class="avatar" src="{{ Auth::user()->getProfilePicture()}}" />
    </a>
    <div class="card-body">
        <h5 class="card-title">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
