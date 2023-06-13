<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT DATA PENDUDUK</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: linear-gradient(to left, #494E6B  ,#192231)">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
            <div class="card border-0 shadow rounded" style="background:linear-gradient(to left,  #FEB47B, #68BAA7  );">
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">FOTO</label>
                                <input type="file" class="form-control" name="foto_penduduk">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $post->nik) }}" placeholder="Masukkan NIK">
                            
                                <!-- error message untuk title -->
                                @error('nik')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA PENDUDUK</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="nama_penduduk" rows="5" placeholder="Masukkan Nama Penduduk">{{ old('nama_penduduk', $post->nama_penduduk) }}</textarea>
                            
                                <!-- error message untuk content -->
                                @error('nama_penduduk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
</body>
</html>