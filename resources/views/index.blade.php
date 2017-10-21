<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Team Name</th>
                                <th>Match Timetable</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @forelse($teams as $team)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="#" class="team_title" data-id="{{$team->id}}">{{$team->team_name}}</a></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @empty
                                <p>No team yet. Add one</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Admin Settins</h3>
                        <p>Some content in menu 1.</p>
                    </div>
                </div>

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add team</button>

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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('.team_title').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            var id = $this.data('id');
            axios.get('/team/'+id)
                .then(function (response) {
                    console.log(response['data']['team']['id']);
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
                })
                .catch(function (error) {
                    console.log(error);
                });
            $("#info").modal();
        })
    </script>
    </body>
</html>
