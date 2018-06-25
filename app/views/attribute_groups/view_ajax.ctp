<tr>
    <td class="dl">
        <h4><?php echo $attributeGroup['AttributeGroup']['display_name']; ?></h4>
    </td>
</tr>
<tr>
    <td class="dl">
        <?php echo $this->Form->input('name'); ?>
    </td>
    <?php if($attributeGroup['AttributeGroupType']['id'] == ConstAttributeGroupType::Color) { ?>
    <td class="dl">
        <?php echo $this->Form->input('attribute_group_type_value'); ?>
    </td>
    <?php } ?>
</tr>