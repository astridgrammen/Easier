@extends('layouts.layout')

@section('content')
<section id="testimonials" class="testimonials section-bg ">
    <div class="container">
        <div class="section-title" >
            <h2>Beschikbaarheden</h2>
            <p> Hieronder vindt u de beschikbaarheden</p>
        </div>
    </div>

    <div class="text-center">
        @guest
        <p></p>
    
        @else    
        <a href="/availabilities/create" class="btn-link">Maak beschikbaarheid aan</a>
        @endguest
        
    </div>

    

    
    
    @if(count($availabilities) > 0)
    @foreach($availabilities as $availability)
    @guest

    
    <div class="row justify-content-center">
        <div class="testimonial-item col-lg-4 col-md-6 ">
            <div><h3>{{$availability->subject}}<h3></div>
            <p>{{$availability->date}}</p>
            <p>{{$availability->time}}</p>

            <a href="/availabilities/new-appointment/{{$availability->id}}" class="btn btn-info">Maak deze afspraak</a>
        </div>
    </div>

    @else

    <div class="row justify-content-center">
        <div class="testimonial-item  col-lg-2 col-md-6  text-center">
            <a href="#" class="blauw">{{$availability->subject}}</a>
            <p>{{$availability->date}}</p> 
            <p>{{$availability->time}}</p>


            @if(Auth::user()->id == $psycholoog->user_id)

             <form action="{{ route('availabilities.destroy', $availability->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- edit button -->
                <button type="button" class="btn btn-success  "><a href="/availabilities/{{$availability->id}}/edit">Bewerk beschikbaarheid</a></button><br>
                
                <!-- delete button -->
                    <button type="submit" class="btn btn-danger ">Delete</button>
            </form>

            @endif

        </div>
    </div>
    

    @endguest
       

    @endforeach()

@else
<div class="text-center">
    @guest
    <p>Er zijn geen beschikbaarheden voor deze psycholoog</p>

    @endguest
</div>
    
</div>
@endif
</section>


   
        
   
   
    

@endsection