<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" indent="yes" version="4.0"
		doctype-public="-//W3C//DTD HTML 4.01//EN" doctype-system="http://www.w3.org/TR/html4/strict.dtd" />

	<xsl:template match="/">
		<html>
			<head>
				<style>
					#goods {
					font-family: "Trebuchet MS", Arial, Helvetica,
					sans-serif;
					border-collapse: collapse;
					margin:auto;
					}

					#goods td, #goods
					th {
					border: 1px solid #ddd;
					padding: 8px;
					}

					#goods tr:nth-child(even){
					background-color: #f2f2f2;
					}

					#goods tr:hover{
					background-color: #ddd;
					}

					#goods th{
					padding-top: 12px;
					padding-bottom: 12px;
					text-align: left;
					background-color: #4CAF50;
					color: white;
					}
				</style>
			</head>
			<body>

				<table id="goods">
					<tr>
						<td>
							<div>Shopping Catalog</div>
						</td>
					</tr>
					<tr>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Description</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Add </th>
					</tr>
					<xsl:for-each select="/goods/item">
						<xsl:if test="quantityavailable &gt; 0">
							<tr>
								<td>
									<xsl:value-of select="itemnumber" />
								</td>
								<td>
									<xsl:value-of select="itemname" />
								</td>
								<td>
									<xsl:value-of select="description" />
								</td>
								<td>
									$
									<xsl:value-of select="price" />
								</td>
								<td>
									<xsl:value-of select="quantityavailable" />
								</td>
								<td>
									<input type="button" onclick="manageCart(event, 'addToCart')"
										value="Add One to Cart" />
								</td>
							</tr>
						</xsl:if>
					</xsl:for-each>
				</table>
				<br />
				<br />
				<table id="goods">
					<tr>
						<td>
							<div>Shopping Cart</div>
						</td>
					</tr>
					<tr>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Remove </th>
					</tr>
					<xsl:for-each select="/goods/item">
						<xsl:if test="quantityonhold &gt; 0">
							<tr class="shoppingCartRow">
								<td>
									<xsl:value-of select="itemnumber" />
								</td>
								<td>
									<xsl:value-of select="itemname" />
								</td>
								<td>
									$
									<xsl:value-of select="price" />
								</td>
								<td>
									<xsl:value-of select="quantityonhold" />
								</td>
								<td>
									<input type="button" onclick="manageCart(event, 'removeFromCart')"
										value="Remove from Cart" />
								</td>
							</tr>
						</xsl:if>
					</xsl:for-each>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Total :
						</td>
						<td>
							$
							<xsl:value-of select="sum(/goods/item[quantityonhold&gt;0]/price)" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="button" onclick="processPurchase(event, 'confirmPurchase')" value="Confirm Purchase" />
						</td>
						<td></td>
						<td></td>
						<td>
							<input type="button" onclick="processPurchase(event, 'cancelPurchase')" value="Cancel Purchase" />
						</td>
					</tr>
				</table>


			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
