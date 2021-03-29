
@foreach ($comments as $comment)
<div class="row user-comment">
    <div class="col-md-3 user">
        <div style="font-weight: bold">{{$comment->users->name}}</div>
        
        <img
            src={{asset("images/users/" .
            $comment->users->photo)
                
            }}
            class="rounded-circle"
        />
    </div>
    
    <div class="col-md-9 comment" >
        <span style="font-weight:600">{{$comment->comment}}</span>
        
        {{--  calculate date difference for every comment  --}}
        {{--  diff_date() is autoloaded from app\helpers\general.php    --}}
        <span class="date_com"> {{diff_date($comment->created_at)}}</span>
        
                
        @if ($comment->user_id == Auth::user()->id)
            <a class="btn btn-info edit-btn" href="{{url('comments/edit/'.$comment->id)}}">edit</a>
            <a class="btn btn-danger delete-btn"  href="{{url('comments/delete/'.$comment->id)}}">delete</a>
        @endif
    </div>
</div>
@endforeach