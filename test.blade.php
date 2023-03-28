@extends('layouts.app')
@section('content')
    <h1 class="center">Le procès-verbal</h1>
    <table class="table table-striped" id="Pvs">
            <thead>
                <tr>
                    <th>
                        <select name="nom_ville" id="nom_ville" class="form-control">
                            <option value="0">Ville</option>
                            @foreach ($villes as $ville)
                                <option value="{{$ville->nom_ville}}">{{$ville->nom_ville}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="nom_cmp" id="nom_cmp" class="form-control">
                            <option value="0">Complexe</option>
                            @foreach ($complexes as $item)
                                <option value="{{$item->nom_cmp}}">{{$item->nom_cmp}}</option>
                            @endforeach
                       </select>
                    </th>
                    <th>
                        <select name="nom_Etb" id="nom_Etb" class="form-control">
                            <option value="Etb">Etablissement</option>
                                @foreach ($Etb as $Et)
                                    <option value="{{$Et->nom_Etb}}">{{$Et->nom_Etb}}</option>
                                @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="date" id="date" class="form-control">
                            <option value="date">date</option>
                            @for($i = date('Y'); $i >= date('Y') - 100; $i--)
                                <option value="{{ $i }}" >{{ $i }}</option>
                            @endfor
                        </select>
                    </th>
                    <th class="form-control" name='pv_file'> 
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($My_view as $item)
                    <tr>
                        <td>{{$item->nom_ville}}</td>
                        <td>{{$item->nom_cmp}}</td>
                        <td>{{$item->nom_Etb}}</td>
                        <td>{{$item->date}}</td>
                        <td>
                            <a href="#" class="btn btn-primary">Télécharger</a>
                            <a href="#" class="btn btn-danger">Supprimer</a>
                            <a href="#" class="btn btn-warning">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{-- 
            <th>pv_file</th> --}}
        {{-- </tr>
        @foreach ($My_view as $item)
        <tr>
            
            <td>{{$item->pv_file}}</td>
        </tr> --}}
    {{-- @endforeach --}}
    </table>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script> 
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

   
     
</head>
    <script type="text/javascript">
    $.fn.dataTable.ext.errMode = 'throw';
        $(document).ready(function(){
            function fetch_data(nom_cmp='',nom_ville='',nom_Etb='',date){
                $('#Pvs').DataTable({
                    processing:true,
                    serverSide:true,
                    ajax:{
                        url:"{{route('MyPvs.index')}}",
                        data:{nom_ville:nom_ville,nom_cmp:nom_cmp,nom_Etb:nom_Etb,date:date}
                    },
                    columns:[
                        {
                            data:'nom_ville',
                            name:'nom_ville',

                        },
                        {
                            data:'nom_cmp',
                            name:'nom_cmp'
                        },
                        {
                            data:'nom_Etb',
                            name:'nom_Etb'
                        },
                        {
                            data:'date',
                            name:'date'
                        },
                        {
                            data:'pv_file',
                            name:'pv_file'
                        }
                    ]
                })

            }

            

            $('#nom_ville').change(function(){
                var nom_ville=$('#nom_ville').val();
                $('#Pvs').DataTable().destroy();
                fetch_data('',nom_ville,'','');
            })
            $('#nom_cmp').change(function(){
                var nom_cmp=$('#nom_cmp').val();
                $('#Pvs').DataTable().destroy();
                fetch_data(nom_cmp,'','','')
            })
            $('#nom_Etb').change(function(){
                var nom_Etb=$('#nom_Etb').val();
                $('#Pvs').DataTable().destroy();
                fetch_data('','',nom_Etb,'')
            })
            $('#date').change(function(){
                var date=$('#date').val();
                $('#Pvs').DataTable().destroy();
                fetch_data('','','',date)
            })
        })
    </script>
@endsection