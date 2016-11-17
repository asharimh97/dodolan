@extends('layouts.admin')
@section('title', 'Dashboard')
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
		<div class="row pd-bt-20">
			<div class="col-md-12">
				<table class="table table-striped table-hover no-border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>User data</th> <!-- username and password -->
                            <th>Gender</th>
                            <th class="col-md-3">Address</th> <!-- phone number included -->
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ; ?>
                        @foreach($users as $user)
                        @if($user->role == 'user')
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email.'(@'.$user->username.')' }}</td>
                            <td>
                                @if($user->gender == 'Perempuan')
                                <span class="label label-danger">Female</span>
                                @else
                                <span class="label label-info">Male</span>
                                @endif
                            </td>
                            <td>
                                {{ $user->alamat }}
                                <br>
                                <i class="fa fa-phone"></i> +62{{ $user->telp }}
                            </td>
                            <td>{{ convertDate($user->created_at) }}</td>
                            <td>
                                <a href="{{ url('/profile/'.$user->id) }}" class="btn btn-default" title="View user"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/admin/user/delete/'.$user->id) }}" class="btn btn-warning" title="Delete user"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++ ; ?>
                        @endif
                        @endforeach
                    </tbody>         
                </table>
			</div>
		</div>
	</div>
</section>
@endsection