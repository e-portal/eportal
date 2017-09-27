@foreach($comments as $comment)
    @if($parent != $comment->parent_id)
        @continue
    @endif
    <ul class="children">
        <li class="childrens">
            <div class="post-content">
                <div class="avatar-time">
                    <span>{{ $comment->name }}</span>#{{ $comment->id }}
                    <time>
                        {{
                            date('d', strtotime($comment->created_at))
                             . ' '
                             . trans('ru.m' . date('m', strtotime($comment->created_at)))
                             . ' '
                             . date('Y', strtotime($comment->created_at))
                             . ', '
                             . date('H:i', strtotime($comment->created_at))
                        }}
                    </time>
                </div>
                <p>{{ $comment->text }}</p>

            </div>
        </li>
    </ul>
@endforeach