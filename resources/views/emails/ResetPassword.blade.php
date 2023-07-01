<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<div class="row h-100">
    <div class="col-sm-12 my-auto">
        {{-- <form action="https://phplaravel-1025967-3619615.cloudwaysapps.com/api/forgin_password/reset_password" method="post">
    @csrf
    <input type="hidden" name="email" value="{{$email}}">

        <button type="submit"
            style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">Go
            To Reset The Password</button>
        </form> --}}
        <div class="container">
            <div class="card text-center" style="width: 300px;">
                <div class="card-header h5 text-white bg-primary">Password Reset</div>
                <div class="card-body px-5">
                    <p class="card-text py-2">
                        Enter your email address and we'll send you an email with instructions to reset your password.
                    </p>
                    <form
                        action="https://phplaravel-1025967-3619615.cloudwaysapps.com/api/forgin_password/reset_password"
                        method="post">
                        <div class="form-outline">
                            <input type="text" required id="password" name="password" class="form-control my-3"
                                pattern=".{8,}" title="at least 8 or more characters" required />
                            <label class="form-label" for="password">password input</label>
                            {{-- @error('password')
                <small class="text-danger">
                    {{ $message }}
                            </small>
                            @enderror --}}

                        </div>
                        <div class="form-outline">
                            <input type="text" pattern=".{8,}" title="at least 8 or more characters" required
                                id="password_confirmation" name="password_confirmation" class="form-control my-3" />
                            <label class="form-label" for="password_confirmation">confairmed input</label>
                            @isset($errors)
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @endisset


                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>

</script>

</html>