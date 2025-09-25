<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Bugis Water Park</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="hero-banner">
        <img src="{{ asset('images/aquapark_slide.jpg') }}" alt="Selamat Datang di Bugis Water Park">
    </div>
    <div class="main-container"></div>

    <div class="main-container">
        <div class="summary-wrapper">
            <div class="rating-summary">
                @php
                    $numberWords = [5 => 'FIVE', 4 => 'FOUR', 3 => 'THREE', 2 => 'TWO', 1 => 'ONE'];
                @endphp
                @for ($i = 5; $i >= 1; $i--)
                <div class="summary-row">
                    <div class="summary-label">{{ $numberWords[$i] }} <i class="fa fa-star star-icon"></i></div>
                    <div class="progress-bar">
                        <div class="progress" style="width: {{ $totalUlasan > 0 ? ($ratingCounts->get($i, 0) / $totalUlasan) * 100 : 0 }}%;"></div>
                    </div>
                    <div class="summary-count">{{ $ratingCounts->get($i, 0) }}</div>
                </div>
                @endfor
            </div>
            <div class="average-rating">
                <div class="average-score">{{ number_format($averageRating, 1) }}</div>
                <div class="average-stars">
                    @for ($j = 1; $j <= 5; $j++)
                        <i class="fa fa-star star-icon {{ $j <= round($averageRating) ? 'filled' : '' }}"></i>
                    @endfor
                </div>
                <div class="total-ratings">{{ $totalUlasan }} Ratings</div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="feedbacks">
                <h2>Recent Feedbacks</h2>
                <div id="feedback-list">
                    @forelse($ulasan as $u)
                        <div class="review-card">
                            <div class="review-card-header">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($u->nama) }}&background=ffc107&color=fff" alt="Avatar" class="avatar">
                                <div class="review-card-info">
                                    <strong>{{ $u->nama }}</strong>
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star star-icon {{ $i <= $u->rating ? 'filled' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p>{{ $u->komentar }}</p>
                        </div>
                    @empty
                        <p class="no-reviews">Belum ada ulasan. Jadilah yang pertama!</p>
                    @endforelse
                </div>

                @if(\App\Models\Ulasan::count() > 3)
                    <button id="load-more-btn" class="load-more-button">Load More</button>
                @endif
            </div>

            <div class="review-form">
                <h2>Add a Review</h2>
                @if(session('success'))
                    <p class="success-message">{{ session('success') }}</p>
                @endif
                <form action="/ulasan" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="rating-label">Add Your Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required/><label for="star5" title="Sangat Puas"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Puas"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Cukup"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kurang Puas"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Tidak Puas"></label>
                        </div>
                    </div>
                    <input type="text" name="nama" placeholder="Nama Anda" required>
                    <input type="email" name="email" placeholder="Email Anda (Opsional)">
                    <textarea name="komentar" rows="5" placeholder="Write Your Review..." required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
