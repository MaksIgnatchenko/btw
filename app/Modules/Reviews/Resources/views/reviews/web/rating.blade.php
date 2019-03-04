<ul class="rating__list">
    @foreach(range(1,5) as $rating)
        <li class="rating__item rating__item--small"><img
                    src="/img/{{$rating <= $owner->rating ? 'star-active' : 'star'}}.svg" alt="filled star icon">
        </li>
    @endforeach
</ul>