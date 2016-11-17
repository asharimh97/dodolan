@extends('layouts.admin')
@section('title', 'Feedbacks')
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
				<table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th class="col-md-3">Description</th>
                            <th class="col-md-3">Feedback by</th>
                            <th>Feedback date</th>
                            <th>Action</th>
                        </tr>
                    </thead>            
                    <tbody>
                        <?php $i = 0 ;?>
                        @foreach ($feedbacks as $feed)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $feed->title }}</td>
                            <td>{{ $feed->feedback }}</td>
                            <td>{{ $feed->name }}<br> {{ '('.$feed->email.')' }}</td>
                            <td>{{ convertDate($feed->created_at) }}</td>
                            <td>
                                <a href="{{ url('admin/feedback/delete/'.$feed->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i></a>
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