<article class="p-post__wr">
    <h6 class="p-post__title">{{$review->customer_full_name}}</h6>
   @include('reviews.web.rating', ['owner' => $review])
    <div class="p-post__cont">
        {{$review->comment}}
    </div>
    <div class="p-post__date">
        <span>{{$review->created_at->format('d M Y')}}</span>
    </div>

</article>