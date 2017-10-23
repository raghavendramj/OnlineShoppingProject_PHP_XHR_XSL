<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" indent="yes" version="4.0"
		doctype-public="-//W3C//DTD HTML 4.01//EN" doctype-system="http://www.w3.org/TR/html4/strict.dtd" />

	<xsl:template match="/">
		<html>
			<head>
				<style>
					#maintenance {
					font-family: "Trebuchet MS", Arial, Helvetica,
					sans-serif;
					border-collapse: collapse;
					margin:auto;
					}

					#maintenance td, #goods th {
					border: 1px solid #ddd;
					padding: 8px;
					}

					#goods tr:nth-child(even){
						background-color: #f2f2f2;
					}
					#maintenance tr:hover {
						background-color: #ddd;
					}

					#maintenance th {
						padding-top: 12px;
						padding-bottom: 12px;
						text-align: left;
						background-color: #4CAF50;
						color: white;
					}
				</style>
			</head>
		</html>
		<table id="maintenance">
			<tr>
				<th>Item Number</th>
				<th>Name</th>
				<th>Category</th>
				<th>Description</th>
				<th>Reserve Price</th>
				<th>Buy It Now Price</th>
				<th>Current Bid Price</th>
				<th>Start Date</th>
				<th>Start Time</th>
				<th>Status</th>
			</tr>
			<xsl:for-each select="//item[status='SOLD' or status='FAILED']">
				<tr>
					<td>
						<xsl:value-of select="itemid" />
					</td>
					<td>
						<xsl:value-of select="itemname" />
					</td>
					<td>
						<xsl:value-of select="category" />
					</td>
					<td>
						<xsl:value-of select="description" />
					</td>
					<td>
						<xsl:value-of select="reserveprice" />
					</td>
					<td>
						<xsl:value-of select="buyitnowprice" />
					</td>
					<td>
						<xsl:value-of select="bidprice" />
					</td>
					<td>
						<xsl:value-of select="startdate" />
					</td>
					<td>
						<xsl:value-of select="starttime" />
					</td>
					<td>
						<xsl:value-of select="status" />
					</td>
				</tr>
			</xsl:for-each>
		</table>
		<ul>
			<li>
				<p>
					<b>Revenue from sold items: </b>
					<xsl:value-of select=".03*sum(//item[status='SOLD']/bidprice)" />
				</p>
			</li>
			<br />
			<li>
				<p>
					<b>Revenue from failed items: </b>
					<xsl:value-of select=".01*sum(//item[status='FAILED']/reserveprice)" />
				</p>
			</li>
			<br />
			<li>
				<p>
					<b>Total Revenue is:</b>
					<xsl:value-of
						select="(0.03*sum(//item[status='SOLD']/bidprice))+(0.01*sum(//item[status='FAILED']/reserveprice))" />
				</p>
			</li>
		</ul>
	</xsl:template>
</xsl:stylesheet>
