<?php foreach($getvendors as $getvendor) { ?>
                            <tr>
                                <td>
                                    <?php echo $getvendor['v_id'];?>
                                </td>
                                <td>
                                    <?php echo $getvendor['vendor_name'];?>
                                </td>
                                <td>
                                    <?php echo $getvendor['email'];?>
                                </td>
                                <td>
                                    <?php echo $getvendor['phone'];?>
                                </td>
                                <td>
                                    <?php echo $getvendor['vendor_status'];?>
                                </td>
                                
                            </tr>
							<?php } ?>