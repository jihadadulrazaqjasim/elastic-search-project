@include('partials.header')

<style>

li.nav-item{
      color: red
   }

   a.nav-link{
      color: red
   }
   a.nav_link span{
      color: red;
   }
</style>

{{-- Page specific styles --}}
@yield('styles')

<body id="page-top">

        <!-- Page Wrapper -->
     <div id="wrapper">

        {{-- Include Sidebar --}}
        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- @include('partials.navbar') --}}

               
             {{-- Yeild Content Here --}}
                @yield('content')

            </div>
            <!-- End of Main Content -->
            
            {{-- Include footer --}}
            @include('partials.footer')
            
            {{-- Page specific javascript files --}}
            @yield('javascripts')
</body>
</html>