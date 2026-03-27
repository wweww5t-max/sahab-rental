<h1>Dashboard</h1>

<p>Welcome {{ auth()->user()->name }}</p>

<ul>
    <li><a href="/contracts">Contracts</a></li>
    <li><a href="/customers">Customers</a></li>
    <li><a href="/vehicles">Vehicles</a></li>
</ul>