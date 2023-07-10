<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<h2 class="breadcrumb-title">
					<?=$page_title?>
				</h2>
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<?=$page_title?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>



<div class="content">
	<div class="container-fluid">
		<div class="row">

			<?php require_once('menu.php'); ?>

			<div class="col-md-7 col-lg-8 col-xl-9">
				<div class="card">
					<div class="card-header dct-appoinment">

						<nav class="user-tabs mb-0">
							<ul class="nav nav-tabs nav-tabs-bottom">
								<li class="nav-item">
									<a class="nav-link active" href="#pending-orders" data-bs-toggle="tab">Pending</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#in-process-orders" data-bs-toggle="tab"><span class="med-records">IN Process</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#on-way-orders" data-bs-toggle="tab">ON Way</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#delivered-orders" data-bs-toggle="tab">Delivered</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#returned-orders" data-bs-toggle="tab">Returned</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#cancelled-orders" data-bs-toggle="tab">Cancelled</a>
								</li>
							</ul>
						</nav>

					</div>
					<div class="card-body p-0">

						<div class="tab-content pt-0">

							<div id="pending-orders" class="tab-pane fade show active">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Amount</th>
														<th>Delivery Detail</th>
														<th>Items</th>
														<th>Method</th>
														<th>AT</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($orders as $key => $q): ?>
														<?php if ($q['status'] != 'pending'): ?>
															<?php continue; ?>
														<?php endif ?>
														<tr id="order-row-<?=$q['order_id']?>">
															<td><?=$q['order_id']?></td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Sub Total</td>
																		<td><?=$q['sub_total']?></td>
																	</tr>
																	<tr>
																		<td>Tax</td>
																		<td><?=$q['tax']?></td>
																	</tr>
																	<tr>
																		<td>Deliver Charges</td>
																		<td><?=$q['deliver_charges']?></td>
																	</tr>
																	<tr>
																		<td>Discount</td>
																		<td><?=$q['discount']?></td>
																	</tr>
																	<tr>
																		<td><strong>Total</strong></td>
																		<td><?=$q['total']?></td>
																	</tr>
																</table>
															</td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Address Line 1</td>
																		<td><?=$q['address_line_1']?></td>
																	</tr>
																	<tr>
																		<td>Address Line 2</td>
																		<td><?=$q['address_line_2']?></td>
																	</tr>
																	<tr>
																		<td>City</td>
																		<td><?=$q['cityName']?></td>
																	</tr>
																	<tr>
																		<td>State</td>
																		<td><?=$q['stateName']?></td>
																	</tr>
																</table>
															</td>
															<td><?=$q['items']?></td>
															<td><?=$q['payment_method']?></td>
															<td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
															<td>
																<?php if ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill info-status">Pending</span>
																<?php elseif ($q['status'] == 'in process'): ?>
																	<span class="badge rounded-pill info-status">IN Process</span>
																<?php elseif ($q['status'] == 'on way'): ?>
																	<span class="badge rounded-pill warning-status">ON Way</span>
																<?php elseif ($q['status'] == 'delivered'): ?>
																	<span class="badge rounded-pill success-status">Delivered</span>
																<?php elseif ($q['status'] == 'returned'): ?>
																	<span class="badge rounded-pill danger-status">Returned</span>
																<?php elseif ($q['status'] == 'cancelled'): ?>
																	<span class="badge rounded-pill danger-status">Cancelled</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-order-info" data-id="<?=$q['order_id']?>" title="Order Details">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript:del_q('<?=$q['order_id']?>')" class="btn btn-sm bg-danger-light" title="Cancel This Order ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #pending-orders -->

							<div id="in-process-orders" class="tab-pane fade">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Amount</th>
														<th>Delivery Detail</th>
														<th>Items</th>
														<th>Method</th>
														<th>AT</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($orders as $key => $q): ?>
														<?php if ($q['status'] != 'in process'): ?>
															<?php continue; ?>
														<?php endif ?>
														<tr id="order-row-<?=$q['order_id']?>">
															<td><?=$q['order_id']?></td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Sub Total</td>
																		<td><?=$q['sub_total']?></td>
																	</tr>
																	<tr>
																		<td>Tax</td>
																		<td><?=$q['tax']?></td>
																	</tr>
																	<tr>
																		<td>Deliver Charges</td>
																		<td><?=$q['deliver_charges']?></td>
																	</tr>
																	<tr>
																		<td>Discount</td>
																		<td><?=$q['discount']?></td>
																	</tr>
																	<tr>
																		<td><strong>Total</strong></td>
																		<td><?=$q['total']?></td>
																	</tr>
																</table>
															</td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Address Line 1</td>
																		<td><?=$q['address_line_1']?></td>
																	</tr>
																	<tr>
																		<td>Address Line 2</td>
																		<td><?=$q['address_line_2']?></td>
																	</tr>
																	<tr>
																		<td>City</td>
																		<td><?=$q['cityName']?></td>
																	</tr>
																	<tr>
																		<td>State</td>
																		<td><?=$q['stateName']?></td>
																	</tr>
																</table>
															</td>
															<td><?=$q['items']?></td>
															<td><?=$q['payment_method']?></td>
															<td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
															<td>
																<?php if ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill primary-status">Pending</span>
																<?php elseif ($q['status'] == 'in process'): ?>
																	<span class="badge rounded-pill info-status">IN Process</span>
																<?php elseif ($q['status'] == 'on way'): ?>
																	<span class="badge rounded-pill warning-status">ON Way</span>
																<?php elseif ($q['status'] == 'delivered'): ?>
																	<span class="badge rounded-pill success-status">Delivered</span>
																<?php elseif ($q['status'] == 'returned'): ?>
																	<span class="badge rounded-pill danger-status">Returned</span>
																<?php elseif ($q['status'] == 'cancelled'): ?>
																	<span class="badge rounded-pill danger-status">Cancelled</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-order-info" data-id="<?=$q['order_id']?>" title="Order Details">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript:del_q('<?=$q['order_id']?>')" class="btn btn-sm bg-danger-light" title="Cancel This Order ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #in-process-orders -->

							<div id="on-way-orders" class="tab-pane fade">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Amount</th>
														<th>Delivery Detail</th>
														<th>Items</th>
														<th>Method</th>
														<th>AT</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($orders as $key => $q): ?>
														<?php if ($q['status'] != 'on way'): ?>
															<?php continue; ?>
														<?php endif ?>
														<tr id="order-row-<?=$q['order_id']?>">
															<td><?=$q['order_id']?></td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Sub Total</td>
																		<td><?=$q['sub_total']?></td>
																	</tr>
																	<tr>
																		<td>Tax</td>
																		<td><?=$q['tax']?></td>
																	</tr>
																	<tr>
																		<td>Deliver Charges</td>
																		<td><?=$q['deliver_charges']?></td>
																	</tr>
																	<tr>
																		<td>Discount</td>
																		<td><?=$q['discount']?></td>
																	</tr>
																	<tr>
																		<td><strong>Total</strong></td>
																		<td><?=$q['total']?></td>
																	</tr>
																</table>
															</td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Address Line 1</td>
																		<td><?=$q['address_line_1']?></td>
																	</tr>
																	<tr>
																		<td>Address Line 2</td>
																		<td><?=$q['address_line_2']?></td>
																	</tr>
																	<tr>
																		<td>City</td>
																		<td><?=$q['cityName']?></td>
																	</tr>
																	<tr>
																		<td>State</td>
																		<td><?=$q['stateName']?></td>
																	</tr>
																</table>
															</td>
															<td><?=$q['items']?></td>
															<td><?=$q['payment_method']?></td>
															<td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
															<td>
																<?php if ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill primary-status">Pending</span>
																<?php elseif ($q['status'] == 'in process'): ?>
																	<span class="badge rounded-pill info-status">IN Process</span>
																<?php elseif ($q['status'] == 'on way'): ?>
																	<span class="badge rounded-pill warning-status">ON Way</span>
																<?php elseif ($q['status'] == 'delivered'): ?>
																	<span class="badge rounded-pill success-status">Delivered</span>
																<?php elseif ($q['status'] == 'returned'): ?>
																	<span class="badge rounded-pill danger-status">Returned</span>
																<?php elseif ($q['status'] == 'cancelled'): ?>
																	<span class="badge rounded-pill danger-status">Cancelled</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-order-info" data-id="<?=$q['order_id']?>" title="Order Details">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript:del_q('<?=$q['order_id']?>')" class="btn btn-sm bg-danger-light" title="Cancel This Order ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #on-way-orders -->

							<div class="tab-pane fade" id="delivered-orders">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Amount</th>
														<th>Delivery Detail</th>
														<th>Items</th>
														<th>Method</th>
														<th>AT</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($orders as $key => $q): ?>
														<?php if ($q['status'] != 'delivered'): ?>
															<?php continue; ?>
														<?php endif ?>
														<tr id="order-row-<?=$q['order_id']?>">
															<td><?=$q['order_id']?></td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Sub Total</td>
																		<td><?=$q['sub_total']?></td>
																	</tr>
																	<tr>
																		<td>Tax</td>
																		<td><?=$q['tax']?></td>
																	</tr>
																	<tr>
																		<td>Deliver Charges</td>
																		<td><?=$q['deliver_charges']?></td>
																	</tr>
																	<tr>
																		<td>Discount</td>
																		<td><?=$q['discount']?></td>
																	</tr>
																	<tr>
																		<td><strong>Total</strong></td>
																		<td><?=$q['total']?></td>
																	</tr>
																</table>
															</td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Address Line 1</td>
																		<td><?=$q['address_line_1']?></td>
																	</tr>
																	<tr>
																		<td>Address Line 2</td>
																		<td><?=$q['address_line_2']?></td>
																	</tr>
																	<tr>
																		<td>City</td>
																		<td><?=$q['cityName']?></td>
																	</tr>
																	<tr>
																		<td>State</td>
																		<td><?=$q['stateName']?></td>
																	</tr>
																</table>
															</td>
															<td><?=$q['items']?></td>
															<td><?=$q['payment_method']?></td>
															<td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
															<td>
																<?php if ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill primary-status">Pending</span>
																<?php elseif ($q['status'] == 'in process'): ?>
																	<span class="badge rounded-pill info-status">IN Process</span>
																<?php elseif ($q['status'] == 'on way'): ?>
																	<span class="badge rounded-pill warning-status">ON Way</span>
																<?php elseif ($q['status'] == 'delivered'): ?>
																	<span class="badge rounded-pill success-status">Delivered</span>
																<?php elseif ($q['status'] == 'returned'): ?>
																	<span class="badge rounded-pill danger-status">Returned</span>
																<?php elseif ($q['status'] == 'cancelled'): ?>
																	<span class="badge rounded-pill danger-status">Cancelled</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-order-info" data-id="<?=$q['order_id']?>" title="Order Details">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript:del_q('<?=$q['order_id']?>')" class="btn btn-sm bg-danger-light" title="Cancel This Order ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #delivered-orders -->

							<div id="returned-orders" class="tab-pane fade">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Amount</th>
														<th>Delivery Detail</th>
														<th>Items</th>
														<th>Method</th>
														<th>AT</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($orders as $key => $q): ?>
														<?php if ($q['status'] != 'returned'): ?>
															<?php continue; ?>
														<?php endif ?>
														<tr id="order-row-<?=$q['order_id']?>">
															<td><?=$q['order_id']?></td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Sub Total</td>
																		<td><?=$q['sub_total']?></td>
																	</tr>
																	<tr>
																		<td>Tax</td>
																		<td><?=$q['tax']?></td>
																	</tr>
																	<tr>
																		<td>Deliver Charges</td>
																		<td><?=$q['deliver_charges']?></td>
																	</tr>
																	<tr>
																		<td>Discount</td>
																		<td><?=$q['discount']?></td>
																	</tr>
																	<tr>
																		<td><strong>Total</strong></td>
																		<td><?=$q['total']?></td>
																	</tr>
																</table>
															</td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Address Line 1</td>
																		<td><?=$q['address_line_1']?></td>
																	</tr>
																	<tr>
																		<td>Address Line 2</td>
																		<td><?=$q['address_line_2']?></td>
																	</tr>
																	<tr>
																		<td>City</td>
																		<td><?=$q['cityName']?></td>
																	</tr>
																	<tr>
																		<td>State</td>
																		<td><?=$q['stateName']?></td>
																	</tr>
																</table>
															</td>
															<td><?=$q['items']?></td>
															<td><?=$q['payment_method']?></td>
															<td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
															<td>
																<?php if ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill primary-status">Pending</span>
																<?php elseif ($q['status'] == 'in process'): ?>
																	<span class="badge rounded-pill info-status">IN Process</span>
																<?php elseif ($q['status'] == 'on way'): ?>
																	<span class="badge rounded-pill warning-status">ON Way</span>
																<?php elseif ($q['status'] == 'delivered'): ?>
																	<span class="badge rounded-pill success-status">Delivered</span>
																<?php elseif ($q['status'] == 'returned'): ?>
																	<span class="badge rounded-pill danger-status">Returned</span>
																<?php elseif ($q['status'] == 'cancelled'): ?>
																	<span class="badge rounded-pill danger-status">Cancelled</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-order-info" data-id="<?=$q['order_id']?>" title="Order Details">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript:del_q('<?=$q['order_id']?>')" class="btn btn-sm bg-danger-light" title="Cancel This Order ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #returned-orders -->

							<div id="cancelled-orders" class="tab-pane fade">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Amount</th>
														<th>Delivery Detail</th>
														<th>Items</th>
														<th>Method</th>
														<th>AT</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($orders as $key => $q): ?>
														<?php if ($q['status'] != 'cancelled'): ?>
															<?php continue; ?>
														<?php endif ?>
														<tr id="order-row-<?=$q['order_id']?>">
															<td><?=$q['order_id']?></td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Sub Total</td>
																		<td><?=$q['sub_total']?></td>
																	</tr>
																	<tr>
																		<td>Tax</td>
																		<td><?=$q['tax']?></td>
																	</tr>
																	<tr>
																		<td>Deliver Charges</td>
																		<td><?=$q['deliver_charges']?></td>
																	</tr>
																	<tr>
																		<td>Discount</td>
																		<td><?=$q['discount']?></td>
																	</tr>
																	<tr>
																		<td><strong>Total</strong></td>
																		<td><?=$q['total']?></td>
																	</tr>
																</table>
															</td>
															<td>
																<table class="table table-bordered">
																	<tr>
																		<td>Address Line 1</td>
																		<td><?=$q['address_line_1']?></td>
																	</tr>
																	<tr>
																		<td>Address Line 2</td>
																		<td><?=$q['address_line_2']?></td>
																	</tr>
																	<tr>
																		<td>City</td>
																		<td><?=$q['cityName']?></td>
																	</tr>
																	<tr>
																		<td>State</td>
																		<td><?=$q['stateName']?></td>
																	</tr>
																</table>
															</td>
															<td><?=$q['items']?></td>
															<td><?=$q['payment_method']?></td>
															<td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
															<td>
																<?php if ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill primary-status">Pending</span>
																<?php elseif ($q['status'] == 'in process'): ?>
																	<span class="badge rounded-pill info-status">IN Process</span>
																<?php elseif ($q['status'] == 'on way'): ?>
																	<span class="badge rounded-pill warning-status">ON Way</span>
																<?php elseif ($q['status'] == 'delivered'): ?>
																	<span class="badge rounded-pill success-status">Delivered</span>
																<?php elseif ($q['status'] == 'returned'): ?>
																	<span class="badge rounded-pill danger-status">Returned</span>
																<?php elseif ($q['status'] == 'cancelled'): ?>
																	<span class="badge rounded-pill danger-status">Cancelled</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-order-info" data-id="<?=$q['order_id']?>" title="Order Details">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript:del_q('<?=$q['order_id']?>')" class="btn btn-sm bg-danger-light" title="Cancel This Order ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #cancelled-orders -->

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>