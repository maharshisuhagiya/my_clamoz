@extends('layout.wrapper')

@section('content')

<style>
    .tab-btn {
        padding: 10px 18px;
        cursor: pointer;
        font-weight: 600;
        border-radius: 5px;
        margin-right: 10px;
        background: #e8e8e8;
        display: inline-block;
        transition: .2s;
    }

    .tab-btn.active {
        background: #1586b0 !important;
        color: #fff !important;
    }

    .tab-section { display: none; }
    .tab-section.active { display: block; }

    .card-custom {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        overflow: hidden;
        margin-top: 20px;
    }

    .reward-box {
        background: #e8fff0;
        border: 1px solid #b2f0c3;
        padding: 18px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .ref-box {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dcdcdc;
    }
</style>

<div class="container" style="padding: 25px;">

    <!-- 🔥 TOP TABS -->
    <div class="mb-3">
        <span class="tab-btn active" data-tab="ref-link">Referral Link</span>
        <span class="tab-btn" data-tab="ref-users">Referred Users List</span>
    </div>

    <!-- CARD BODY -->
    <div class="card card-custom shadow-sm">
        <div class="card-body">

            <!-- TAB 1 -->
            <div id="tab-ref-link" class="tab-section active">

                <div class="reward-box">
                    <h4>Total Reward Points Earned</h4>
                    <h2 class="text-success">{{ $totalRewardPoints }}</h2>
                </div>

                <div class="ref-box">
                    <h4>Your Referral Link</h4>
                    <p>Share this link with others and earn rewards.</p>

                    <input type="text" 
                        class="form-control mb-3" 
                        value="{{ url('signup?ref=' . auth()->user()->referral_code) }}" 
                        readonly>

                    <button class="btn btn-primary" onclick="copyReferral()">Copy Link</button>
                </div>
            </div>

            <!-- TAB 2 -->
            <div id="tab-ref-users" class="tab-section">
                <div class="ref-box">
                    <h4>Users You Referred</h4>
                    <p class="mb-3">Below is the list of users & reward earned from each.</p>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Date Joined</th>
                                <th>Reward Earned</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($referredUsers as $key => $ref)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $ref->first_name }} {{ $ref->last_name }}</td>

                                    <td>{{ $ref->email }}</td>

                                    <td>{{ optional($ref->created)->format('d M Y') ?? 'N/A' }}</td>

                                    <td class="text-success fw-bold">
                                        {{ $ref->earned_reward }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No referred users yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection


@section('scripts')
<script>
    // TOP TAB SWITCHING
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            // remove active from all tabs
            document.querySelectorAll('.tab-btn')
                .forEach(x => x.classList.remove('active'));

            this.classList.add('active');

            // hide all sections
            document.querySelectorAll('.tab-section')
                .forEach(sec => sec.classList.remove('active'));

            // show selected section
            document.getElementById("tab-" + this.dataset.tab).classList.add('active');
        });
    });

    function copyReferral() {
        let input = document.querySelector("input[readonly]");
        input.select();
        document.execCommand("copy");
        alert("Referral link copied!");
    }
</script>
@endsection
