<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        
                @if($comments->isEmpty())
                    {{-- If comment does not exist or has not been inputted show nothing --}}
                @else
            <!-- Fluid width widget -->        
    	    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-comment"></span> 
                        Recent Comments
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="media-list">
                        @foreach($comments as $comment)
                            <li class="media">
                                <div class="media-left">
                                    @if($comment->user->avatar)
                                    <img src="/uploads/avatars/{{ $comment->user->avatar }}" class="img-circle" style="width:32px; height:32px; border-radius:50%;">

                                    @else
                                    <img src="/uploads/avatars/user.jpg" class="img-circle" style="width:32px; height:32px; border-radius:50%;">                                    

                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                    
                                        <small>
                                            <a href="">{{ $comment->user->first_name }} {{ $comment->user->last_name }} -{{ $comment->user->email }}</a>
                                            <br>
                                            commented on {{$comment->created_at}}
                                        </small>
                                    </h4>
                                    <p>
                                        {{ $comment->body}} 
                                    </p>
                                    <b>Proof:</b>
                                    <p>
                                        {{ $comment->url}} 
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <!-- End fluid width widget --> 
        </div>
</div>