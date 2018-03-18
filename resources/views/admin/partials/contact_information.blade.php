@if (empty($member->info))

<span>No Information has been added to this user.</span>


@else

<div class="row row-deck gutters-tiny">
    <!-- Billing Address -->
    <div class="col-md-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Billing Address</h3>
            </div>
            <div class="block-content">
                <div class="font-size-lg text-black mb-5">{{ $member->info->first_name }} {{ $member->info->last_name }}</div>
                <address>
                    House Number : {{ $member->info->house_number }} <br>
                    {{ $member->info->street_name }} <br>
                    Postal Code : {{ $member->info->postal_code }} <br><br>
                    <i class="fa fa-phone mr-5"></i> {{ $member->info->mobile_phone }}<br>
                    <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)"> {{ $member->info->alternate_email }}</a>
                </address>
            </div>
        </div>
    </div>
    <!-- END Billing Address -->

    <!-- Shipping Address -->
    <div class="col-md-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Billing Address</h3>
            </div>
            <div class="block-content">
                <div class="font-size-lg text-black mb-5">{{ $member->info->first_name }} {{ $member->info->middle_name }}  {{ $member->info->last_name }}</div>
                <address>
                    House Number : {{ $member->info->house_number }} <br>
                    {{ $member->info->street_name }} <br>
                    Postal Code : {{ $member->info->postal_code }} <br><br>
                    <i class="fa fa-phone mr-5"></i> {{ $member->info->mobile_phone }}<br>
                    <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)"> {{ $member->info->alternate_email }}</a>
                </address>
            </div>
        </div>
    </div>
    <!-- END Shipping Address -->
</div>
<!-- END Addresses -->
@endif
