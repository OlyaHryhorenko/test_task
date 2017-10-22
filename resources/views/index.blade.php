<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link  rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" />
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }


            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Football Team</h1>
            </div>
            <div class="row">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Matches</a></li>
                    <li><a data-toggle="tab" href="#menu1">Settings</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>Upcoming matches</h3>
                        <table class="table table-bordered datatable">
                            <thead>
                                <th>#</th>
                                <th>Host Team</th>
                                <th>Score</th>
                                <th>Guest Team</th>

                            </thead>
                            <tbody>
                            @forelse($matches as $match)
                                <tr>

                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="#" class="team_title" data-id="{{$match->id}}">{{$match->host_team->team_name}}</a></td>
                                    <td>{{$match->host_team_result}} : {{$match->guest_team_result}}</td>
                                    <td><a href="#" class="team_title" data-id="{{$match->id}}">{{$match->guest_team->team_name}}</a></td>

                                </tr>
                            @empty
                                <p>No team yet. Add one</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Admin Settins</h3>
                        <div class="card clearfix">
                            <div class="card-block">
                                <h4 class="card-title">Add new match</h4>
                                <form id="form_new_match">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Choose host team</label>
                                           <select class="form-control" name="host_team" id="host_team" required>
                                               @foreach($teams as $team)
                                                   <option value="{{$team->id}}">{{$team->team_name}}</option>
                                               @endforeach
                                           </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Choose guest team</label>
                                            <select class="form-control" name="guest_team" id="guest_team" required>
                                                @foreach($teams as $team)
                                                    <option value="{{$team->id}}">{{$team->team_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Select match date</label>
                                            <input type="text"  id='datetimepicker' name="date"  class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="btn btn-success" type="submit" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card clearfix">
                            <div class="card-block">
                                <h4 class="card-title">Add new team</h4>
                                <form id="add-team">
                                    <div class="form-group">
                                        <input type="text" name="team_name" id="team_name" class="form-control" placeholder="Add team nameW">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-success" type="submit" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card clearfix">
                            <div class="card-block">
                                <h4 class="card-title">Add match results</h4>
                                <form id="add_match_result">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <select name="match" class="form-control" id="match">
                                                    @foreach($matches_without_results as $match_without_result)
                                                        <option value="{{$match_without_result->id}}">{{$match_without_result->host_team->team_name}}:{{$match_without_result->guest_team->team_name}} ({{$match_without_result->match_date}})</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input type="number" placeholder="Host team goals" class="form-control" id="host_team_goals">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="number" placeholder="Guest team goals" class="form-control"  id="guest_team_goals">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <input class="btn btn-success" type="submit" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Modal -->
        <div id="info" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add team</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered team_data">
                            <thead>
                                <th>#</th>
                                <th>Team Name</th>
                                <th>GP</th>
                                <th>W</th>
                                <th>D</th>
                                <th>L</th>
                                <th>GF</th>
                                <th>GA</th>
                                <th>GD</th>
                                <th>home</th>
                                <th>away</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <script
                src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $('.datatable').dataTable({});
            $('.team_title').click(function(e) {
                e.preventDefault();
                var $this = $(this);
                var id = $this.data('id');
                axios.get('/team/'+id)
                    .then(function (response) {
                        console.log(['data']['team_data']);
                        if (['data']['team_data'] == undefined) {
                            console.log('empty');
                        } else {
                            $('.team_data tbody').append("<tr>"+
                                "<td>"+response['data']['team_data']['gp'] +"</td>"+
                                "<td>"+response['data']['team_data']['w'] +"</td>"+
                                "<td>"+response['data']['team_data']['d'] +"</td>"+
                                "<td>"+response['data']['team_data']['l'] +"</td>"+
                                "<td>"+response['data']['team_data']['gf'] +"</td>"+
                                "<td>"+response['data']['team_data']['ga'] +"</td>"+
                                "<td>"+response['data']['team_data']['gd'] +"</td>"+
                                "<td>"+response['data']['team_data']['home'] +"</td>"+
                                "<td>"+response['data']['team_data']['away'] +"</td>"+
                                "</tr>")
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                $("#info").modal();
            })

            $(function () {
                $('#datetimepicker').datetimepicker();
            });

            $('#form_new_match').on('submit', function(e)
            {
                e.preventDefault();
                var host_team = $(this).find('#host_team').val();
                var guest_team = $(this).find('#guest_team').val();
                var raw_date = $(this).find('#datetimepicker').val();
                var date =new Date(raw_date).toISOString().substring(0, 19).replace('T', ' ')

                axios.post('/add-match', {
                    host_team: host_team,
                    guest_team: guest_team,
                    date: date
                })
                    .then(function (response) {
                        console.log();
                        if (response['data']['error']) {
                            alert(response['data']['error']);
                        } else if (response['data']['success']) {
                            alert(response['data']['success'])
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });
            $('#add-team').on('submit', function (e) {
                e.preventDefault();
                var team_name = $(this).find('#team_name').val();
                axios.post('/add-team', {
                    team_name: team_name
                })
                    .then(function (response) {
                        alert(response['data']['success'])
                    })
                    .catch(function (error) {
                        alert('The value must not be empty')
                    });
            });
            $('#add_match_result').on('submit', function(e) {
                e.preventDefault();
                var match_id = $(this).find('#match').val();
                var host_goals = $(this).find('#host_team_goals').val();
                var guest_goals = $(this).find('#guest_team_goals').val();
                axios.post('/add-match-results', {
                    match_id: match_id,
                    host_goals: host_goals,
                    guest_goals: guest_goals
                })
                    .then(function (response) {
                        console.log();
                        if (response['data']['error']) {
                            alert(response['data']['error']);
                        } else if (response['data']['success']) {
                            alert(response['data']['success'])
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })
        });

    </script>
    </body>
</html>
