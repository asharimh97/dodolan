@extends('layouts.admin')
@section('title', 'Testimonials')
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
				<table class="table table-striped table-hover no-border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="col-md-3">Testimonial</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>          
                    <tbody>
                        <?php $i = 1 ; ?>
                        @foreach($testimonials as $testi)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $testi->testimoni_desc }}</td>
                                <td>{{ $testi->name }}</td>
                                <td>
                                    @for ($j=0; $j<$testi->rating; $j++)
                                    <i class="fa fa-star"></i>
                                    @endfor
                                </td>
                                <td>
                                    <a href="" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>  
                </table>
			</div>
		</div>
	</div>
</section>
@endsection