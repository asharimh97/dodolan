@extends('layouts.admin')
@section('title', 'Teams')
@section ('content')
<?php 
    function convertDate($date){
        $thn = substr($date, 0, 4) ;
        $bln = substr($date, 5, 2) ;
        $tgl = substr($date, 8, 2) ;
        $blne ;
        switch($bln){
            case 1 : $blne = "January"; break ;
            case 2 : $blne = "February"; break ;
            case 3 : $blne = "March"; break ;
            case 4 : $blne = "April"; break ;
            case 5 : $blne = "May"; break ;
            case 6 : $blne = "June"; break ;
            case 7 : $blne = "July"; break ;
            case 8 : $blne = "August"; break ;
            case 9 : $blne = "September"; break ;
            case 10 : $blne = "October"; break ;
            case 11 : $blne = "November"; break ;
            case 12 : $blne = "December"; break ;
        }

        return $tgl.' '.$blne.' '.$thn ;
    }
?>
<section id="page-content">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <a href="" class="btn btn-success mont">Add new team member</a>
            </div>        
			<div class="col-md-12">
				<table class="table table-striped table-hover no-border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th class="col-md-3">Bio</th>
                            <th>Role</th>
                            <th>Social media ccount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ;?>
                        @foreach($teams as $team)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->bio }}</td>
                            <td>{{ $team->role }}</td>
                            <td>
                                <ul class="social-team-links">
                                    <li><a href="{{ $team->youtube }}" data-toggle="tooltip" data-placement="top" title="Youtube" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                                    <li><a href="{{ $team->facebook }}" data-toggle="tooltip" data-placement="top" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ $team->twitter }}" data-toggle="tooltip" data-placement="top" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ $team->instagram }}" data-toggle="tooltip" data-placement="top" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="{{ $team->google }}" data-toggle="tooltip" data-placement="top" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </td>
                            <td>
                                <a href="{{ url('admin/team/view/'.$team->id_team) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('admin/team/edit/'.$team->id_team) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('admin/team/delete/'.$team->id_team) }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</section>
@endsection