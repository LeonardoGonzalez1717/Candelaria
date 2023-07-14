     
                                        <?php
                                        if(!empty($estu)): 
                                               while($estu_ante = mysqli_fetch_assoc($estu)){
                                           ?>

                                
                                             <input  type="number" name="nota" value="<?=$estu_ante['nota']?>" />
                                             <?php } ?>
                                            </td> 
                                            <td><input type="number" name="lapso" min="1" max="3" value="<?=$estu_ante['lapso']?>"/></td>
                                        
                                
                                        <?php else: ?>
                                          <td><input type="number" name="nota"/></td>
                                          <?php endif;?>
                                        