<x-layout>
    <!-- Dashboard Header -->
    <h2>Dashboard</h2>
    <hr/>
 
    <div class="row">
        <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
            <h3>{{ $totalOrders }}</h3>

            <p>Total Orders</p>
            </div>
            <div class="icon">
            <i class="fa-solid fa-cart-shopping"></i>
            </div> 
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
            <h3>${{ number_format($totalSales, 2) }}</h3>

            <p>Total Sales</p>
            </div>
            <div class="icon">
            <i class="fa-solid fa-chart-simple"></i>
            </div> 
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
            <h3>{{ $totalClients }}</h3>

            <p>Total Clients</p>
            </div>
            <div class="icon"> 
            <i class="fa-solid fa-users"></i>
            </div> 
        </div>
        </div>
        <!-- ./col -->
    </div>



    <div class="card">
        <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Order Summary
        </h3>
        <div class="card-tools">
        
        </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                    style="position: relative; height: 430px;"> 
                    
    
                    <!-- Monthly Orders Chart -->
                    <div class="text-center"> 
                        <!-- Time Range Selection Form -->
                        <form action="{{ route('admin.dashboard') }}" method="GET" style="display: inline-block; margin-bottom: 20px;">
                            <div class="form-group">
                                <label for="timeRange" class="mr-2">Time Range: </label>
                                <select name="timeRange" id="timeRange" class="form-control" style="width: auto; display: inline-block;">    
                                    <option value="weekly" {{ request('timeRange') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ request('timeRange') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                </select>

                                
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary">Update Report</button> 
                                <a href="{{ route('reports.index') }}" class="btn btn-primary">View All Reports</a>
                            </div>
                        </form> 
                    </div>    
                    
                    <div class="chart-container" style="position: relative; max-height:500px; height:40vh; width:80vw; margin: auto;">
                        {!! $chartHTML !!} <!-- Render the chart for monthly orders -->
                    </div>
    
                    <!-- Ensure there is enough space above the footer -->
                    <div style="margin-bottom: 200px;"></div> 

                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // SweetAlert or other JS code can go here if needed
                        });
                
                        let resizeTimer;
                        window.addEventListener('resize', () => {
                            clearTimeout(resizeTimer);
                            resizeTimer = setTimeout(() => {
                                // Reloads the current page
                                window.location.reload();
                            }, 100);
                        });
                    </script>

                    
                </div>  

                
                
            </div>
        </div><!-- /.card-body -->
    </div>





</x-layout>

