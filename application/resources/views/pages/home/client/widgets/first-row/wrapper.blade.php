<div class="row">
    
    <style>
        .referral-marquee {
            background: linear-gradient(90deg, #fff3cd, #ffe69c);
            border: 1px solid #ffdd57;
            border-radius: 8px;
            padding: 10px 0;
            overflow: hidden;
            position: relative;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .marquee-track {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            animation: marqueeScroll 18s linear infinite;
            font-size: 15px;
            font-weight: 600;
            color: #664d03;
        }

        @keyframes marqueeScroll {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
    </style>

    <div class="col-12 mb-3">
        <div class="referral-marquee">
            <div class="marquee-track">
                🎁 <strong>Refer & Earn $15 Each Referral!!</strong>
                Join our Referral Program and start earning with ease!
                Refer your friends & family and earn up to <strong>$50</strong> per successful referral.
            </div>
        </div>
    </div>

    <!--PROJECTS PENDING-->
    @include('pages.home.client.widgets.first-row.projects-pending')

    <!--PROJECTS COMPLETED-->
    @include('pages.home.client.widgets.first-row.projects-completed')

    <!--INVOICES DUE-->
    @include('pages.home.client.widgets.first-row.invoices-due')

    <!--INVOICES OVERDUE-->
    @include('pages.home.client.widgets.first-row.invoices-overdue')
</div>