@if(count($errors) > 0) <!-- za traženje grešaka unutar forme-->
<div class="row">
    <div class="col-md-4 col-md-offset-4 error"> <!-- jer imamo 12 boja grid u bootstrap  -->
        <ul>
            @foreach($errors->all() as $error) <!-- outputa listu -->
                <li>{{$error}}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@if(Session::has('message'))
    <div class="row">
        <div class="col-md-4 col-md-offset-4 success"> <!-- jer imamo 12 boja grid u bootstrap  -->
            {{Session::get('message')}} <!-- mestoda message -->
        </div>
    </div>
    @endif