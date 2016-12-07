@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Restos</div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Restaurant name</th>
                            <th>Genre</th>
                            <th>Pricing</th>
                            <th>Number of reviews</th>
                            <th>Average rating</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach($restos as $resto)
                                <tr>
                                    <!-- Resto Name -->
                                    <td class="table-text">
                                        <div><a href="{{ url('/detailResto/'.$resto->restoid) }}">{{$resto->name}}</a></div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$resto->genre}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$resto->pricing}}</div>
                                    </td><td class="table-text">
                                        <div>
                                            <?php $num = 0; ?>
                                            @foreach($reviews as $review)
                                                @if($review->resto == $resto->restoid)
                                                    <?php $num++ ?>
                                                @endif
                                            @endforeach
                                            {{$num}}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            <?php $sum = 0; $avg = 0; $num = 0; ?>
                                            @foreach($reviews as $review)
                                                @if($review->resto == $resto->restoid)
                                                    <?php
                                                    $sum += $review->rating;
                                                    $num++;
                                                    ?>
                                                @endif
                                            @endforeach
                                            <?php

                                            if($sum == 0)
                                                $avg = 0;
                                            else
                                                $avg = (int) $sum / $num;
                                            ?>
                                            {{number_format($avg, 1)}}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <a href="/updateResto/{{$resto->restoid}}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div> {{ $restos->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection