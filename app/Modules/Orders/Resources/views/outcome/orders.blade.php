<table class="table" id="orders-table">
    <thead>
    <tr>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Purchase date</th>
        <th scope="col">Redemption date</th>
        <th scope="col">Customer</th>
        <th scope="col">Return policy</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
        @each('outcome.order', $merchantOrders, 'order')
    </tbody>
</table>