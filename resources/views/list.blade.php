<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{$name}} - NBQ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h1>Queue list: {{$name}}</h1>

            <div class="row">
                <div class="pull-right">
                    Show user messages:
                     <div class="btn-group btn-toggle"> 
                        <button class="btn btn-default btn-sm">ON</button>
                        <button class="btn btn-default active btn-sm">OFF</button>
                    </div>
                </div>
            </div>

            <div class="row">
                @if(isset($queues) && !empty($queues))
                @foreach($queues as $queue)
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#c{{$queue->id}}">Queue: <b>{{$queue->name}}</b>@if($queue->id == $channel->active), status: <b> @if($queue->is_open == 1)Open @else Closed @endif </b>@endif</a>
                            </h4>
                        </div>
                        <div id="c{{$queue->id}}" class="panel-collapse collapse @if($queue->id == $channel->active && $queue->is_open == 1)in @endif">
                            <ul class="list-group">
                                @if(isset($queue->users) && !empty($queue->users))
                                @foreach($queue->users as $i => $user)
                                <li class="list-group-item">{{$i+1}}. {{$user->user->displayName}}<span class="badge badge-primary badge-pill">Remove / Promote ID: {{$user->id}}</span>
                                    @if(trim($user->message) != "")<blockquote class="user-message">{{$user->message}}</blockquote>@endif
                                </li>
                                @endforeach
                                @else
                                <li class="list-group-item">Queue is empty</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <style>
            blockquote.user-message {
                font-size: 14px;
            }
            .btn-default.active {
                background-color: #777;
                color: #fff;
            }
            .user-message {
                display: none;
        }
        </style>
        <script>
            $('.btn-toggle').click(function() {
                $(this).find('.btn').toggleClass('active');
                $('.user-message').toggle();
            });
        </script>
    </body>
</html>