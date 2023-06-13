<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Penduduk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: linear-gradient(to left, #494E6B  ,#192231)">

    <div class="container mt-5">
        <div class="row" >
            <div class="col-md-12">
                <div class="card border-0 shadow rounded" style="background:linear-gradient(to left,  #FEB47B, #68BAA7  );">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA PENDUDUK</a>
                        <table class="table table-bordered" style="background-color: cadetblue;">
                            <thead>
                              <tr>
                                <th scope="col">FOTO</th>
                                <th scope="col">NIK</th>
                                <th scope="col">NAMA PENDUDUK</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/posts/').$post->foto_penduduk }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $post->nik }}</td>
                                    <td>{!! $post->nama_penduduk !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>