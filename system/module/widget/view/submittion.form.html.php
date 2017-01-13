<tr>
  <th><?php echo $lang->widget->lblNum;?></th>
  <td><?php echo html::input('params[limit]', $widget ? zget($widget->params, 'limit', 8) : 8, "class='form-control w-400px'");?></td>
</tr>
