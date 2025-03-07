<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			font-family: {{ config('settings.report.font_name', '"Courier New", Courier, monospace') }};
			font-size: {{ config('settings.report.font_size', '13px') }};
		}
		body,h1,h2,h3,h4,h5,h6 {
			margin: 0px;
			padding: 0px;
			
		}
		small {
			font-size: small;
			color: #888;
		}

		@if(config('settings.report.include_header') === 'yes')
		#report-header {
			position: relative;
			border-bottom: 10px double #0066cc;
			background: #fafafa;
			padding: 10px;
		}
		#report-header table {
			margin: 0;
		}
		#report-header .sub-title {
			font-size: small;
			color: #888;
		}
		#report-header img {
			height: 50px;
			width: 50px;
		}
		@endif

		#report-title {
			padding: 20px 0;
			border-bottom: 1px solid #ddd;
		}

		#report-body{
			padding: 0 20px;
			min-height: 500px;
			
		}
		@if(config('settings.report.include_footer') === 'yes')
		#report-footer {
			padding: 10px;
			background: #fafafa;
			border-top: 2px solid #0066cc;
			margin: 0 auto;
		}
		#report-footer table {
			margin: 0;
			overflow: hidden;
		}

		#report-footer .footer-content {
			text-align: right;
			vertical-align: middle;
		}
		@endif
		
		table,
		.table {
			width: 100%;
			max-width: 100%;
			margin-bottom: 1rem;
			border-collapse: collapse;
		}
		.table th,
		.table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #eceeef;
			text-align: left;
		}
		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #eceeef;
			text-align: left;
		}
		.table tbody+tbody {
			border-top: 2px solid #eceeef;
		}
		.table .table {
			background-color: #fff;
		}
		.table-sm th,
		.table-sm td {
			padding: 0.3rem;
		}
		.table-bordered {
			border: 1px solid #eceeef;
		}
		.table-bordered th,
		.table-bordered td {
			border: 1px solid #eceeef;
		}
		.table-bordered thead th,
		.table-bordered thead td {
			border-bottom-width: 2px;
		}
		.table-striped tbody tr:nth-of-type(odd) {
			background-color: rgba(0, 0, 0, 0.05);
		}
	</style>
</head>
<body>

	@if(config('settings.report.include_header') === 'yes')
	<div id="report-header">
		<table class="table table-sm">
			<tr>
				<th valign="middle">
					<h3 class="company-name">{{ config('settings.org.name') }}</h3>
					<small class="sub-title">{{ config('settings.org.tagline') }}</small>
				</th>
				<th style="text-align:right" valign="middle" width="40%">
					<div class="company-info">
						<div>Phone: <span class="sub-title">{{ config('settings.org.phone') }}</span></div>
						<div>Email: <span class="sub-title">{{ config('settings.org.email') }}</span></div>
					</div>
				</th>
			</tr>
		</table>
	</div>
	@endif

	<div id="report-body">
		@yield('content')
	</div>

	@if(config('settings.report.include_footer') === 'yes')
    <div id="report-footer">
		<table class="table table-sm">
			<tr>
				<td class="footer-content" valign="middle">
					{{ str_replace('{YEAR}', now()->year, config('settings.report.footer_content')) }}
				</td>
			</tr>
		</table>
	</div>
	@endif

	<script>
		window.print();
	</script>
</body>

</html>