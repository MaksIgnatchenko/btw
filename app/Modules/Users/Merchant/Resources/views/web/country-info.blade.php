@extends('layouts.merchants.app')

@section('content')
<!-- Main -->
<div class="main contact-page">
    <div class="container ">
        <form class="contact-form" action="/" method="post" name="contact-form">
            <h6 class="contact-info__title">Add your contact information</h6>
            <div class="form-wrapper-half">
                <div class="form-content-half">
                    <p>
                        <input type="text" name="contact-first-name" placeholder="First name">
                    </p>
                </div>
                <div class="form-content-half">
                    <p>
                        <input type="text" name="contact-last-name" placeholder="Last name">
                    </p>
                </div>
            </div>
            <div class="form-content custom-select">
                <select name="contact-location" id="contact-location">
                    <option value="" disabled selected>Country/Region</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Canada">Canada</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Estonia">Estonia</option>
                    <option value="France">France</option>
                    <option value="Spain">Spain</option>
                    <option value="Spain">United Kingdom</option>
                    <option value="Spain">Vatican City</option>
                </select>
            </div>
            <div class="form-wrapper-half">
                <div class="form-content-half">
                    <p>
                        <input type="text" name="contact-first-name" placeholder="State">
                    </p>
                </div>
                <div class="form-content-half">
                    <p>
                        <input type="text" name="contact-last-name" placeholder="Street address">
                    </p>
                </div>
            </div>
            <div class="form-wrapper-half">
                <div class="form-content-half">
                    <p>
                        <input type="text" name="contact-first-name" placeholder="City">
                    </p>
                </div>
                <div class="form-content-half">
                    <p>
                        <input type="text" name="contact-last-name" placeholder="Zipcode/Postal code">
                    </p>
                </div>
            </div>
            <h6 class="contact-info__title">Phone number</h6>
            <div class="contact-form-content-wr">
                <div class="contact-small-wrapper">
                    <p>
                        <input type="text" name="country-phone" placeholder="Country">
                    </p>
                </div>
                <div class="contact-small-wrapper">
                    <p>
                        <input type="text" name="area-phone" placeholder="Area">
                    </p>
                </div>
                <div class="contact-mid-wrapper">
                    <p>
                        <input type="tel" name="number-phone" placeholder="Number">
                    </p>
                </div>
            </div>
            <div class="contact-form-example">
                <p>
                    <span class="contact-form-example__cont">Ex. + 1 - 234 - 5678910</span>
                    <span class="contact-form-example__cont">Ex. + 86 -- 13912345678</span>
                    <span class="contact-form-example__cont">Ex. + 86 - 21 - 65142545</span>
                </p>
            </div>
            <div class="contact-form-submit">
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
</div><!-- /. end header -->
@endsection