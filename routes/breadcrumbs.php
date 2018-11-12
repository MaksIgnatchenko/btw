<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.11.2018
 */

// Admin panel
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Admin panel', route('admin'));
});

// Admin panel > Merchants
Breadcrumbs::register('merchants', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Merchants', route('merchants.index'));
});

// Admin panel > Merchants > [Merchant]
Breadcrumbs::register('merchant', function ($breadcrumbs, $merchant) {
    $breadcrumbs->parent('merchants');
    $breadcrumbs->push($merchant->business_name, route('merchants.show', $merchant->id));
});

// Admin panel > Customers
Breadcrumbs::register('customers', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Customers', route('customers.index'));
});

// Admin panel > Customers > [Customer]
Breadcrumbs::register('customer', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('customers');
    $breadcrumbs->push($customer->fisrt_name . ' ' . $customer->last_name, route('customers.show', $customer->id));
});

// Admin panel > Categories
Breadcrumbs::register('categories', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Categories', route('categories.index'));
});

// Admin panel > Categories > Add category
Breadcrumbs::register('add-category', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Add root category', route('categories.add'));
});

// Admin panel > Categories > Add subcategory
Breadcrumbs::register('add-subcategory', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Add subcategory', route('categories.add-subcategory', ['id' => $category->id]));
});

// Admin panel > Categories > Edit category
Breadcrumbs::register('edit-category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Edit subcategory', route('categories.edit', ['id' => $category->id]));
});

// Admin panel > Terms & Conditions
Breadcrumbs::register('content', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Terms & Conditions', route('content'));
});

// Admin panel > About Us
Breadcrumbs::register('about-us', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('About Us', route('content.about-us'));
});

// Admin panel > Income payments
Breadcrumbs::register('income-payments', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Income payments', route('payments.income.index'));
});

// Admin panel > Income payments > Income details
Breadcrumbs::register('income-payment', function ($breadcrumbs, $order) {
    $breadcrumbs->parent('income-payments');
    $breadcrumbs->push('Income details', route('payments.income.view', ['id' => $order->id]));
});

// Admin panel > Outcome payments
Breadcrumbs::register('outcome-payments', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Outcome payments', route('outcome.index'));
});
// Admin panel > Outcome payments > Create outcome
Breadcrumbs::register('outcome-payment-create', function ($breadcrumbs) {
    $breadcrumbs->parent('outcome-payments');
    $breadcrumbs->push('Outcome details', route('outcome.create'));
});

// Admin panel > Outcome payments > Outcome details
Breadcrumbs::register('outcome-payment', function ($breadcrumbs, $outcome) {
    $breadcrumbs->parent('outcome-payments');
    $breadcrumbs->push('Outcome details', route('outcome.edit', ['id' => $outcome->id]));
});