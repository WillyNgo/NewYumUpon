@extends('layouts.app')

@section('content')
    <script src="/js/review.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="text-align: center">{{$resto->name}}</h1></div>

                    <div class="panel-body">
                        <h2 style="text-align: center" >Type of cuisine</h2>
                        <h4  style="text-align: center" >{{$resto->genre}}</h4>

                        <hr>
                        <h2 style="text-align: center" >Pricing</h2>
                        <h4  style="text-align: center" >
                            <!-- Displays appropriate number of $ for pricing range -->
                            <?php
                            $range = $resto->pricing;
                            switch ($range){
                                case "1":
                                    echo "$";
                                    break;
                                case "2":
                                    echo "$$";
                                    break;
                                case "3":
                                    echo "$$$";
                                    break;
                                case "4":
                                    echo "$$$$";
                                    break;
                                default:
                                    echo "Not available";
                            }
                            ?>
                        </h4>

                        <hr>
                        <h2 style="text-align: center" >Location</h2>
                        <h4  style="text-align: center" >{{$resto->address}}</h4>
                        <h4  style="text-align: center" >{{$resto->city}}</h4>
                        <h4  style="text-align: center" >{{$resto->postalcode}}</h4>

                        <h2 style="text-align: center" >Reviews</h2>
                        @if(count($reviews)>0)
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                <th>Title</th>
                                <th>Username</th>
                                <th>Content</th>
                                <th>Rating</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <!-- Review info -->
                                        <td class="table-text">
                                            <div>{{$review->title}}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{$review->name}}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{$review->content}}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{$review->rating}}</div>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3 style="text-align: center">No reviews!</h3>
                        @endif

                        @if(Auth::check())
                            <button id="submitButton">Add Review</button>
                            <form style="display: none" id="reviewing" class="form-horizontal" role="form" method="POST" action="{{ url('/review') }}">
                                {{ csrf_field() }}

                                <h2  style="text-align: center"> Review Submission Form</h2>
                                <input hidden name="restoid" value="{{$resto->restoid}}">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Content</label>

                                    <div class="col-md-6">

                                        <textarea style="resize: vertical" name="content" class="form-control" form="reviewing"></textarea>
                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <label for="rating" class="col-md-4 control-label">Rating</label>
                                <div class="col-md-6">
                                    <select name="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    @if ($errors->has('rating'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('rating') }}</strong>
                                </span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" >
                                            Post Review!
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <h4 style="text-align: center">Please log in if you want to review this restaurant!</h4>
                        @endif
                        <div> {{ $reviews->links() }} </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection