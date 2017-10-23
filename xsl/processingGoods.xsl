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

					#goods
					tr:nth-child(even){background-color: #f2f2f2;}

					#goods tr:hover
					{background-color: #ddd;}

					#goods th {
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
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Price</th>
						<th>Quantity Available</th>
						<th>Quantity On Hold</th>
						<th>Quantity Sold</th>
					</tr>
					<xsl:for-each select="//item">
								<tr>
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
										<xsl:value-of select="quantityavailable" />
									</td>
									<td>
										<xsl:value-of select="quantityonhold" />
									</td>
									<td>
										<xsl:value-of select="quantitysold" />
									</td>
								</tr>
					</xsl:for-each>
				</table>
			</body>
		</html>


	</xsl:template>
</xsl:stylesheet>
