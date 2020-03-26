<div class="card">
    <div class="card-header bg-white p-4">
        @if(!$eligible)
            On accepte
            <strong>{{ $survey->limitPerParticipant() }} {{ \Str::plural('entrée', $survey->limitPerParticipant()) }}</strong>
            par participant.
        @endif

        @if($lastEntry)
            Vous avez soumis votre réponse <strong>{{ $lastEntry->created_at->diffForHumans() }}</strong>.
        @endif

    </div>
    @if(!$survey->acceptsGuestEntries() && auth()->guest())
        <div class="p-5">
            Please login to join this survey.
        </div>
    @else
    <form action="{{action('SurveyController@answers', ['survey' => $survey->id])}}" method="post">
        @csrf
        @foreach($survey->sections as $section)
            @include('survey::sections.single')
        @endforeach

        @foreach($survey->questions()->withoutSection()->get() as $question)
            @include('survey::questions.single')
        @endforeach

        @if($eligible)
        <div class="form-group">
            <button class="btn btn-primary">Submit</button>
        </div>
        @endif
        </form>
    @endif
</div>
