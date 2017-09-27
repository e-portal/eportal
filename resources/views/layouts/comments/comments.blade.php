@if(!empty($comments) && is_object($comments) && $comments->isNotEmpty())
    <ul id="post-list" class="post-list">
        <hr>
        <div><p>Комментарии ({{ $comments->count() }})</p></div>
        @foreach($comments as $comment)
            @if(0 != $comment->parent_id)
                @continue
            @endif
            <li>
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
                    <p>
                        {{ $comment->text }}
                    </p>
                    <div class="content-answer" data-parent="{{ $comment->id }}">
                        <a>ответ</a>
                    </div>

                </div>
                @include('layouts.comments.children', ['comments' => $comments, 'parent' => $comment->id])
            </li>
        @endforeach
    </ul>
    <hr>
@endif