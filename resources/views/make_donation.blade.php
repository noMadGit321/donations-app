<x-header></x-header>
<div class="container">
    <div class="d-flex h-75 align-items-center">
        <form class="form-control needs-validation" action="/donation/make" method="POST" novalidate>
            @csrf
            <div class="d-flex justify-content-center">
                <h1>Make donation</h1>
            </div>
            <div class="mb-3 fs-5">
                <label for="inputName" class="form-label">Your name:</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="inputName" name="name" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3 fs-5">
                <label for="inputEmail" class="form-label">Email address:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"  id="inputEmail" name="email" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3 fs-5">
                <label for="inputDonation" class="form-label">Donation ammount:</label>
                <input type="number" class="form-control @error('donation') is-invalid @enderror" value="{{old('donation')}}" id="inputDonation" name="donation" required>
                @error('donation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3 fs-5">
                <label for="inputMessage" class="form-label">Free message:</label>
                <textarea type="text" class="form-control @error('message') is-invalid @enderror" value="{{old('message')}}" id="inputMessage" name="message"></textarea>
                <div id="emailHelp" class="form-text">You can leave it empty.</div>
                @error('message')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning">Donate</button>
        </form>
    </div>
</div>
