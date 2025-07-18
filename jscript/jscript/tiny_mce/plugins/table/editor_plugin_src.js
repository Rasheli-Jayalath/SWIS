/**
 * $Id: editor_plugin_src.js 750 2008-03-27 12:32:58Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function() {
	var each = tinymce.each;

	tinymce.create('tinymce.plugins.TablePlugin', {
		init : function(ed, url) {
			var t = this;

			t.editor = ed;
			t.url = url;

			// Register buttons
			each([
				['table', 'table.desc', 'mceInsertTable', true],
				['delete_table', 'table.del', 'mceTableDelete'],
				['delete_col', 'table.delete_col_desc', 'mceTableDeleteCol'],
				['delete_row', 'table.delete_row_desc', 'mceTableDeleteRow'],
				['col_after', 'table.col_after_desc', 'mceTableInsertColAfter'],
				['col_before', 'table.col_before_desc', 'mceTableInsertColBefore'],
				['row_after', 'table.row_after_desc', 'mceTableInsertRowAfter'],
				['row_before', 'table.row_before_desc', 'mceTableInsertRowBefore'],
				['row_props', 'table.row_desc', 'mceTableRowProps', true],
				['cell_props', 'table.cell_desc', 'mceTableCellProps', true],
				['split_cells', 'table.split_cells_desc', 'mceTableSplitCells', true],
				['merge_cells', 'table.merge_cells_desc', 'mceTableMergeCells', true]
			], function(c) {
				ed.addButton(c[0], {title : c[1], cmd : c[2], ui : c[3]});
			});

			ed.onInit.add(function() {
				if (ed && ed.plugins.contextmenu) {
					ed.plugins.contextmenu.onContextMenu.add(function(th, m, e) {
						var sm, se = ed.selection, el = se.getNode() || ed.getBody();

						if (ed.dom.getParent(e, 'td') || ed.dom.getParent(e, 'th')) {
							m.removeAll();

							if (el.nodeName == 'A' && !ed.dom.getAttrib(el, 'name')) {
								m.add({title : 'advanced.link_desc', icon : 'link', cmd : ed.plugins.advlink ? 'mceAdvLink' : 'mceLink', ui : true});
								m.add({title : 'advanced.unlink_desc', icon : 'unlink', cmd : 'UnLink'});
								m.addSeparator();
							}

							if (el.nodeName == 'IMG' && el.className.indexOf('mceItem') == -1) {
								m.add({title : 'advanced.image_desc', icon : 'image', cmd : ed.plugins.advimage ? 'mceAdvImage' : 'mceImage', ui : true});
								m.addSeparator();
							}

							m.add({title : 'table.desc', icon : 'table', cmd : 'mceInsertTable', ui : true, value : {action : 'insert'}});
							m.add({title : 'table.props_desc', icon : 'table_props', cmd : 'mceInsertTable', ui : true});
							m.add({title : 'table.del', icon : 'delete_table', cmd : 'mceTableDelete', ui : true});
							m.addSeparator();

							// Cell menu
							sm = m.addMenu({title : 'table.cell'});
							sm.add({title : 'table.cell_desc', icon : 'cell_props', cmd : 'mceTableCellProps', ui : true});
							sm.add({title : 'table.split_cells_desc', icon : 'split_cells', cmd : 'mceTableSplitCells', ui : true});
							sm.add({title : 'table.merge_cells_desc', icon : 'merge_cells', cmd : 'mceTableMergeCells', ui : true});

							// Row menu
							sm = m.addMenu({title : 'table.row'});
							sm.add({title : 'table.row_desc', icon : 'row_props', cmd : 'mceTableRowProps', ui : true});
							sm.add({title : 'table.row_before_desc', icon : 'row_before', cmd : 'mceTableInsertRowBefore'});
							sm.add({title : 'table.row_after_desc', icon : 'row_after', cmd : 'mceTableInsertRowAfter'});
							sm.add({title : 'table.delete_row_desc', icon : 'delete_row', cmd : 'mceTableDeleteRow'});
							sm.addSeparator();
							sm.add({title : 'table.cut_row_desc', icon : 'cut', cmd : 'mceTableCutRow'});
							sm.add({title : 'table.copy_row_desc', icon : 'copy', cmd : 'mceTableCopyRow'});
							sm.add({title : 'table.paste_row_before_desc', icon : 'paste', cmd : 'mceTablePasteRowBefore'});
							sm.add({title : 'table.paste_row_after_desc', icon : 'paste', cmd : 'mceTablePasteRowAfter'});

							// Column menu
							sm = m.addMenu({title : 'table.col'});
							sm.add({title : 'table.col_before_desc', icon : 'col_before', cmd : 'mceTableInsertColBefore'});
							sm.add({title : 'table.col_after_desc', icon : 'col_after', cmd : 'mceTableInsertColAfter'});
							sm.add({title : 'table.delete_col_desc', icon : 'delete_col', cmd : 'mceTableDeleteCol'});
						} else
							m.add({title : 'table.desc', icon : 'table', cmd : 'mceInsertTable', ui : true});
					});
				}
			});

			// Add undo level when new rows are created using the tab key
			ed.onKeyDown.add(function(ed, e) {
				if (e.keyCode == 9 && ed.dom.getParent(ed.selection.getNode(), 'TABLE'))
					ed.undoManager.add();
			});

			ed.onNodeChange.add(function(ed, cm, n) {
				var p = ed.dom.getParent(n, 'td,th,caption');

				cm.setActive('table', !!p);
				if (p && p.nodeName === 'CAPTION')
					p = null;

				cm.setDisabled('delete_table', !p);
				cm.setDisabled('delete_col', !p);
				cm.setDisabled('delete_table', !p);
				cm.setDisabled('delete_row', !p);
				cm.setDisabled('col_after', !p);
				cm.setDisabled('col_before', !p);
				cm.setDisabled('row_after', !p);
				cm.setDisabled('row_before', !p);
				cm.setDisabled('row_props', !p);
				cm.setDisabled('cell_props', !p);
				cm.setDisabled('split_cells', !p || (parseInt(ed.dom.getAttrib(p, 'colspan', '1')) < 2 && parseInt(ed.dom.getAttrib(p, 'rowspan', '1')) < 2));
				cm.setDisabled('merge_cells', !p);
			});
		},

		execCommand : function(cmd, ui, val) {
			var ed = this.editor, b;

			// Is table command
			switch (cmd) {
				case "mceInsertTable":
				case "mceTableRowProps":
				case "mceTableCellProps":
				case "mceTableSplitCells":
				case "mceTableMergeCells":
				case "mceTableInsertRowBefore":
				case "mceTableInsertRowAfter":
				case "mceTableDeleteRow":
				case "mceTableInsertColBefore":
				case "mceTableInsertColAfter":
				case "mceTableDeleteCol":
				case "mceTableCutRow":
				case "mceTableCopyRow":
				case "mceTablePasteRowBefore":
				case "mceTablePasteRowAfter":
				case "mceTableDelete":
					ed.execCommand('mceBeginUndoLevel');
					this._doExecCommand(cmd, ui, val);
					ed.execCommand('mceEndUndoLevel');

					return true;
			}

			// Pass to next handler in chain
			return false;
		},

		getInfo : function() {
			return {
				longname : 'Tables',
				author : 'Moxiecode Systems AB',
				authorurl : 'http://tinymce.moxiecode.com',
				infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/table',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		},

		// Private plugin internal methods

		/**
		 * Executes the table commands.
		 */
		_doExecCommand : function(command, user_interface, value) {
			var inst = this.editor, ed = inst, url = this.url;
			var focusElm = inst.selection.getNode();
			var trElm = inst.dom.getParent(focusElm, "tr");
			var tdElm = inst.dom.getParent(focusElm, "td,th");
			var tableElm = inst.dom.getParent(focusElm, "table");
			var doc = inst.contentWindow.document;
			var tableBorder = tableElm ? tableElm.getAttribute("border") : "";

			// Get first TD if no TD found
			if (trElm && tdElm == null)
				tdElm = trElm.cells[0];

			function inArray(ar, v) {
				for (var i=0; i<ar.length; i++) {
					// Is array
					if (ar[i].length > 0 && inArray(ar[i], v))
						return true;

					// Found value
					if (ar[i] == v)
						return true;
				}

				return false;
			}

			function select(dx, dy) {
				var td;

				grid = getTableGrid(tableElm);
				dx = dx || 0;
				dy = dy || 0;
				dx = Math.max(cpos.cellindex + dx, 0);
				dy = Math.max(cpos.rowindex + dy, 0);

				// Recalculate grid and select
				inst.execCommand('mceRepaint');
				td = getCell(grid, dy, dx);

				if (td) {
					inst.selection.select(td.firstChild || td);
					inst.selection.collapse(1);
				}
			};

			function makeTD() {
				var newTD = doc.createElement("td");

				if (!tinymce.isIE)
					newTD.innerHTML = '<br mce_bogus="1"/>';
			}

			function getColRowSpan(td) {
				var colspan = inst.dom.getAttrib(td, "colspan");
				var rowspan = inst.dom.getAttrib(td, "rowspan");

				colspan = colspan == "" ? 1 : parseInt(colspan);
				rowspan = rowspan == "" ? 1 : parseInt(rowspan);

				return {colspan : colspan, rowspan : rowspan};
			}

			function getCellPos(grid, td) {
				var x, y;

				for (y=0; y<grid.length; y++) {
					for (x=0; x<grid[y].length; x++) {
						if (grid[y][x] == td)
							return {cellindex : x, rowindex : y};
					}
				}

				return null;
			}

			function getCell(grid, row, col) {
				if (grid[row] && grid[row][col])
					return grid[row][col];

				return null;
			}

			function getTableGrid(table) {
				var grid = [], rows = table.rows, x, y, td, sd, xstart, x2, y2;

				for (y=0; y<rows.length; y++) {
					for (x=0; x<rows[y].cells.length; x++) {
						td = rows[y].cells[x];
						sd = getColRowSpan(td);

						// All ready filled
						for (xstart = x; grid[y] && grid[y][xstart]; xstart++) ;

						// Fill box
						for (y2=y; y2<y+sd['rowspan']; y2++) {
							if (!grid[y2])
								grid[y2] = [];

							for (x2=xstart; x2<xstart+sd['colspan']; x2++)
								grid[y2][x2] = td;
						}
					}
				}

				return grid;
			}

			function trimRow(table, tr, td, new_tr) {
				var grid = getTableGrid(table), cpos = getCellPos(grid, td);
				var cells, lastElm;

				// Time to crop away some
				if (new_tr.cells.length != tr.childNodes.length) {
					cells = tr.childNodes;
					lastElm = null;

					for (var x=0; td = getCell(grid, cpos.rowindex, x); x++) {
						var remove = true;
						var sd = getColRowSpan(td);

						// Remove due to rowspan
						if (inArray(cells, td)) {
							new_tr.childNodes[x]._delete = true;
						} else if ((lastElm == null || td != lastElm) && sd.colspan > 1) { // Remove due to colspan
							for (var i=x; i<x+td.colSpan; i++)
								new_tr.childNodes[i]._delete = true;
						}

						if ((lastElm == null || td != lastElm) && sd.rowspan > 1)
							td.rowSpan = sd.rowspan + 1;

						lastElm = td;
					}

					deleteMarked(tableElm);
				}
			}

			function prevElm(node, name) {
				while ((node = node.previousSibling) != null) {
					if (node.nodeName == name)
						return node;
				}

				return null;
			}

			function nextElm(node, names) {
				var namesAr = names.split(',');

				while ((node = node.nextSibling) != null) {
					for (var i=0; i<namesAr.length; i++) {
						if (node.nodeName.toLowerCase() == namesAr[i].toLowerCase() )
							return node;
					}
				}

				return null;
			}

			function deleteMarked(tbl) {
				if (tbl.rows == 0)
					return;

				var tr = tbl.rows[0];
				do {
					var next = nextElm(tr, "TR");

					// Delete row
					if (tr._delete) {
						tr.parentNode.removeChild(tr);
						continue;
					}

					// Delete cells
					var td = tr.cells[0];
					if (td.cells > 1) {
						do {
							var nexttd = nextElm(td, "TD,TH");

							if (td._delete)
								td.parentNode.removeChild(td);
						} while ((td = nexttd) != null);
					}
				} while ((tr = next) != null);
			}

			function addRows(td_elm, tr_elm, rowspan) {
				// Add rows
				td_elm.rowSpan = 1;
				var trNext = nextElm(tr_elm, "TR");
				for (var i=1; i<rowspan && trNext; i++) {
					var newTD = doc.createElement("td");

					if (!tinymce.isIE)
						newTD.innerHTML = '<br mce_bogus="1"/>';

					if (tinymce.isIE)
						trNext.insertBefore(newTD, trNext.cells(td_elm.cellIndex));
					else
						trNext.insertBefore(newTD, trNext.cells[td_elm.cellIndex]);

					trNext = nextElm(trNext, "TR");
				}
			}

			function copyRow(doc, table, tr) {
				var grid = getTableGrid(table);
				var newTR = tr.cloneNode(false);
				var cpos = getCellPos(grid, tr.cells[0]);
				var lastCell = null;
				var tableBorder = inst.dom.getAttrib(table, "border");
				var tdElm = null;

				for (var x=0; tdElm = getCell(grid, cpos.rowindex, x); x++) {
					var newTD = null;

					if (lastCell != tdElm) {
						for (var i=0; i<tr.cells.length; i++) {
							if (tdElm == tr.cells[i]) {
								newTD = tdElm.cloneNode(true);
								break;
							}
						}
					}

					if (newTD == null) {
						newTD = doc.createElement("td");

						if (!tinymce.isIE)
							newTD.innerHTML = '<br mce_bogus="1"/>';
					}

					// Reset col/row span
					newTD.colSpan = 1;
					newTD.rowSpan = 1;

					newTR.appendChild(newTD);

					lastCell = tdElm;
				}

				return newTR;
			}

			// ---- Commands -----

			// Handle commands
			switch (command) {
				case "mceTableRowProps":
					if (trElm == null)
						return true;

					if (user_interface) {
						inst.windowManager.open({
							url : url + '/row.htm',
							width : 400 + parseInt(inst.getLang('table.rowprops_delta_width', 0)),
							height : 295 + parseInt(inst.getLang('table.rowprops_delta_height', 0)),
							inline : 1
						}, {
							plugin_url : url
						});
					}

					return true;

				case "mceTableCellProps":
					if (tdElm == null)
						return true;

					if (user_interface) {
						inst.windowManager.open({
							url : url + '/cell.htm',
							width : 400 + parseInt(inst.getLang('table.cellprops_delta_width', 0)),
							height : 295 + parseInt(inst.getLang('table.cellprops_delta_height', 0)),
							inline : 1
						}, {
							plugin_url : url
						});
					}

					return true;

				case "mceInsertTable":
					if (user_interface) {
						inst.windowManager.open({
							url : url + '/table.htm',
							width : 400 + parseInt(inst.getLang('table.table_delta_width', 0)),
							height : 320 + parseInt(inst.getLang('table.table_delta_height', 0)),
							inline : 1
						}, {
							plugin_url : url,
							action : value ? value.action : 0
						});
					}

					return true;

				case "mceTableDelete":
					var table = inst.dom.getParent(inst.selection.getNode(), "table");
					if (table) {
						table.parentNode.removeChild(table);
						inst.execCommand('mceRepaint');
					}
					return true;

				case "mceTableSplitCells":
				case "mceTableMergeCells":
				case "mceTableInsertRowBefore":
				case "mceTableInsertRowAfter":
				case "mceTableDeleteRow":
				case "mceTableInsertColBefore":
				case "mceTableInsertColAfter":
				case "mceTableDeleteCol":
				case "mceTableCutRow":
				case "mceTableCopyRow":
				case "mceTablePasteRowBefore":
				case "mceTablePasteRowAfter":
					// No table just return (invalid command)
					if (!tableElm)
						return true;

					// Table has a tbody use that reference
					// Changed logic by ApTest 2005.07.12 (www.aptest.com)
					// Now lookk at the focused element and take its parentNode.  That will be a tbody or a table.
					if (trElm && tableElm != trElm.parentNode)
						tableElm = trElm.parentNode;

					if (tableElm && trElm) {
						switch (command) {
							case "mceTableCutRow":
								if (!trElm || !tdElm)
									return true;

								inst.tableRowClipboard = copyRow(doc, tableElm, trElm);
								inst.execCommand("mceTableDeleteRow");
								break;

							case "mceTableCopyRow":
								if (!trElm || !tdElm)
									return true;

								inst.tableRowClipboard = copyRow(doc, tableElm, trElm);
								break;

							case "mceTablePasteRowBefore":
								if (!trElm || !tdElm)
									return true;

								var newTR = inst.tableRowClipboard.cloneNode(true);

								var prevTR = prevElm(trElm, "TR");
								if (prevTR != null)
									trimRow(tableElm, prevTR, prevTR.cells[0], newTR);

								trElm.parentNode.insertBefore(newTR, trElm);
								break;

							case "mceTablePasteRowAfter":
								if (!trElm || !tdElm)
									return true;
								
								var nextTR = nextElm(trElm, "TR");
								var newTR = inst.tableRowClipboard.cloneNode(true);

								trimRow(tableElm, trElm, tdElm, newTR);

								if (nextTR == null)
									trElm.parentNode.appendChild(newTR);
								else
									nextTR.parentNode.insertBefore(newTR, nextTR);

								break;

							case "mceTableInsertRowBefore":
								if (!trElm || !tdElm)
									return true;

								var grid = getTableGrid(tableElm);
								var cpos = getCellPos(grid, tdElm);
								var newTR = doc.createElement("tr");
								var lastTDElm = null;

								cpos.rowindex--;
								if (cpos.rowindex < 0)
									cpos.rowindex = 0;

								// Create cells
								for (var x=0; tdElm = getCell(grid, cpos.rowindex, x); x++) {
									if (tdElm != lastTDElm) {
										var sd = getColRowSpan(tdElm);

										if (sd['rowspan'] == 1) {
											var newTD = doc.createElement("td");

											if (!tinymce.isIE)
												newTD.innerHTML = '<br mce_bogus="1"/>';

											newTD.colSpan = tdElm.colSpan;

											newTR.appendChild(newTD);
										} else
											tdElm.rowSpan = sd['rowspan'] + 1;

										lastTDElm = tdElm;
									}
								}

								trElm.parentNode.insertBefore(newTR, trElm);
								select(0, 1);
							break;

							case "mceTableInsertRowAfter":
								if (!trElm || !tdElm)
									return true;

								var grid = getTableGrid(tableElm);
								var cpos = getCellPos(grid, tdElm);
								var newTR = doc.createElement("tr");
								var lastTDElm = null;

								// Create cells
								for (var x=0; tdElm = getCell(grid, cpos.rowindex, x); x++) {
									if (tdElm != lastTDElm) {
										var sd = getColRowSpan(tdElm);

										if (sd['rowspan'] == 1) {
											var newTD = doc.createElement("td");

											if (!tinymce.isIE)
												newTD.innerHTML = '<br mce_bogus="1"/>';

											newTD.colSpan = tdElm.colSpan;

											newTR.appendChild(newTD);
										} else
											tdElm.rowSpan = sd['rowspan'] + 1;

										lastTDElm = tdElm;
									}
								}

								if (newTR.hasChildNodes()) {
									var nextTR = nextElm(trElm, "TR");
									if (nextTR)
										nextTR.parentNode.insertBefore(newTR, nextTR);
									else
										tableElm.appendChild(newTR);
								}

								select(0, 1);
							break;

							case "mceTableDeleteRow":
								if (!trElm || !tdElm)
									return true;

								var grid = getTableGrid(tableElm);
								var cpos = getCellPos(grid, tdElm);

								// Only one row, remove whole table
								if (grid.length == 1) {
									inst.dom.remove(inst.dom.getParent(tableElm, "table"));
									return true;
								}

								// Move down row spanned cells
								var cells = trElm.cells;
								var nextTR = nextElm(trElm, "TR");
								for (var x=0; x<cells.length; x++) {
									if (cells[x].rowSpan > 1) {
										var newTD = cells[x].cloneNode(true);
										var sd = getColRowSpan(cells[x]);

										newTD.rowSpan = sd.rowspan - 1;

										var nextTD = nextTR.cells[x];

										if (nextTD == null)
											nextTR.appendChild(newTD);
										else
											nextTR.insertBefore(newTD, nextTD);
									}
								}

								// Delete cells
								var lastTDElm = null;
								for (var x=0; tdElm = getCell(grid, cpos.rowindex, x); x++) {
									if (tdElm != lastTDElm) {
										var sd = getColRowSpan(tdElm);

										if (sd.rowspan > 1) {
											tdElm.rowSpan = sd.rowspan - 1;
										} else {
											trElm = tdElm.parentNode;

											if (trElm.parentNode)
												trElm._delete = true;
										}

										lastTDElm = tdElm;
									}
								}

								deleteMarked(tableElm);

								select(0, -1);
							break;

							case "mceTableInsertColBefore":
								if (!trElm || !tdElm)
									return true;

								var grid = getTableGrid(tableElm);
								var cpos = getCellPos(grid, tdElm);
								var lastTDElm = null;

								for (var y=0; tdElm = getCell(grid, y, cpos.cellindex); y++) {
									if (tdElm != lastTDElm) {
										var sd = getColRowSpan(tdElm);

										if (sd['colspan'] == 1) {
											var newTD = doc.createElement(tdElm.nodeName);

											if (!tinymce.isIE)
												newTD.innerHTML = '<br mce_bogus="1"/>';

											newTD.rowSpan = tdElm.rowSpan;

											tdElm.parentNode.insertBefore(newTD, tdElm);
										} else
											tdElm.colSpan++;

										lastTDElm = tdElm;
									}
								}

								select();
							break;

							case "mceTableInsertColAfter":
								if (!trElm || !tdElm)
									return true;

								var grid = getTableGrid(tableElm);
								var cpos = getCellPos(grid, tdElm);
								var lastTDElm = null;

								for (var y=0; tdElm = getCell(grid, y, cpos.cellindex); y++) {
									if (tdElm != lastTDElm) {
										var sd = getColRowSpan(tdElm);

										if (sd['colspan'] == 1) {
											var newTD = doc.createElement(tdElm.nodeName);

											if (!tinymce.isIE)
												newTD.innerHTML = '<br mce_bogus="1"/>';

											newTD.rowSpan = tdElm.rowSpan;

											var nextTD = nextElm(tdElm, "TD,TH");
											if (nextTD == null)
												tdElm.parentNode.appendChild(newTD);
											else
												nextTD.parentNode.insertBefore(newTD, nextTD);
										} else
											tdElm.colSpan++;

										lastTDElm = tdElm;
									}
								}

								select(1);
							break;

							case "mceTableDeleteCol":
								if (!trElm || !tdElm)
									return true;

								var grid = getTableGrid(tableElm);
								var cpos = getCellPos(grid, tdElm);
								var lastTDElm = null;

								// Only one col, remove whole table
								if (grid.length > 1 && grid[0].length <= 1) {
									inst.dom.remove(inst.dom.getParent(tableElm, "table"));
									return true;
								}

								// Delete cells
								for (var y=0; tdElm = getCell(grid, y, cpos.cellindex); y++) {
									if (tdElm != lastTDElm) {
										var sd = getColRowSpan(tdElm);

										if (sd['colspan'] > 1)
											tdElm.colSpan = sd['colspan'] - 1;
										else {
											if (tdElm.parentNode)
												tdElm.parentNode.removeChild(tdElm);
										}

										lastTDElm = tdElm;
									}
								}

								select(-1);
							break;

						case "mceTableSplitCells":
							if (!trElm || !tdElm)
								return true;

							var spandata = getColRowSpan(tdElm);

							var colspan = spandata["colspan"];
							var rowspan = spandata["rowspan"];

							// Needs splitting
							if (colspan > 1 || rowspan > 1) {
								// Generate cols
								tdElm.colSpan = 1;
								for (var i=1; i<colspan; i++) {
									var newTD = doc.createElement("td");

									if (!tinymce.isIE)
										newTD.innerHTML = '<br mce_bogus="1"/>';

									trElm.insertBefore(newTD, nextElm(tdElm, "TD,TH"));

									if (rowspan > 1)
										addRows(newTD, trElm, rowspan);
								}

								addRows(tdElm, trElm, rowspan);
							}

							// Apply visual aids
							tableElm = inst.dom.getParent(inst.selection.getNode(), "table");
							break;

						case "mceTableMergeCells":
							var rows = [];
							var sel = inst.selection.getSel();
							var grid = getTableGrid(tableElm);

							if (tinymce.isIE || sel.rangeCount == 1) {
								if (user_interface) {
									// Setup template
									var sp = getColRowSpan(tdElm);

									inst.windowManager.open({
										url : url + '/merge_cells.htm',
										width : 240 + parseInt(inst.getLang('table.merge_cells_delta_width', 0)),
										height : 110 + parseInt(inst.getLang('table.merge_cells_delta_height', 0)),
										inline : 1
									}, {
										action : "update",
										numcols : sp.colspan,
										numrows : sp.rowspan,
										plugin_url : url
									});

									return true;
								} else {
									var numRows = parseInt(value['numrows']);
									var numCols = parseInt(value['numcols']);
									var cpos = getCellPos(grid, tdElm);

									if (("" + numRows) == "NaN")
										numRows = 1;

									if (("" + numCols) == "NaN")
										numCols = 1;

									// Get rows and cells
									var tRows = tableElm.rows;
									for (var y=cpos.rowindex; y<grid.length; y++) {
										var rowCells = [];

										for (var x=cpos.cellindex; x<grid[y].length; x++) {
											var td = getCell(grid, y, x);

											if (td && !inArray(rows, td) && !inArray(rowCells, td)) {
												var cp = getCellPos(grid, td);

												// Within range
												if (cp.cellindex < cpos.cellindex+numCols && cp.rowindex < cpos.rowindex+numRows)
													rowCells[rowCells.length] = td;
											}
										}

										if (rowCells.length > 0)
											rows[rows.length] = rowCells;

										var td = getCell(grid, cpos.rowindex, cpos.cellindex);
										each(ed.dom.select('br', td), function(e, i) {
											if (i > 0 && ed.dom.getAttrib('mce_bogus'))
												ed.dom.remove(e);
										});
									}

									//return true;
								}
							} else {
								var cells = [];
								var sel = inst.selection.getSel();
								var lastTR = null;
								var curRow = null;
								var x1 = -1, y1 = -1, x2, y2;

								// Only one cell selected, whats the point?
								if (sel.rangeCount < 2)
									return true;

								// Get all selected cells
								for (var i=0; i<sel.rangeCount; i++) {
									var rng = sel.getRangeAt(i);
									var tdElm = rng.startContainer.childNodes[rng.startOffset];

									if (!tdElm)
										break;

									if (tdElm.nodeName == "TD")
										cells[cells.length] = tdElm;
								}

								// Get rows and cells
								var tRows = tableElm.rows;
								for (var y=0; y<tRows.length; y++) {
									var rowCells = [];

									for (var x=0; x<tRows[y].cells.length; x++) {
										var td = tRows[y].cells[x];

										for (var i=0; i<cells.length; i++) {
											if (td == cells[i]) {
												rowCells[rowCells.length] = td;
											}
										}
									}

									if (rowCells.length > 0)
										rows[rows.length] = rowCells;
								}

								// Find selected cells in grid and box
								var curRow = [];
								var lastTR = null;
								for (var y=0; y<grid.length; y++) {
									for (var x=0; x<grid[y].length; x++) {
										grid[y][x]._selected = false;

										for (var i=0; i<cells.length; i++) {
											if (grid[y][x] == cells[i]) {
												// Get start pos
												if (x1 == -1) {
													x1 = x;
													y1 = y;
												}

												// Get end pos
												x2 = x;
												y2 = y;

												grid[y][x]._selected = true;
											}
										}
									}
								}

								// Is there gaps, if so deny
								for (var y=y1; y<=y2; y++) {
									for (var x=x1; x<=x2; x++) {
										if (!grid[y][x]._selected) {
											alert("Invalid selection for merge.");
											return true;
										}
									}
								}
							}

							// Validate selection and get total rowspan and colspan
							var rowSpan = 1, colSpan = 1;

							// Validate horizontal and get total colspan
							var lastRowSpan = -1;
							for (var y=0; y<rows.length; y++) {
								var rowColSpan = 0;

								for (var x=0; x<rows[y].length; x++) {
									var sd = getColRowSpan(rows[y][x]);

									rowColSpan += sd['colspan'];

									if (lastRowSpan != -1 && sd['rowspan'] != lastRowSpan) {
										alert("Invalid selection for merge.");
										return true;
									}

									lastRowSpan = sd['rowspan'];
								}

								if (rowColSpan > colSpan)
									colSpan = rowColSpan;

								lastRowSpan = -1;
							}

							// Validate vertical and get total rowspan
							var lastColSpan = -1;
							for (var x=0; x<rows[0].length; x++) {
								var colRowSpan = 0;

								for (var y=0; y<rows.length; y++) {
									var sd = getColRowSpan(rows[y][x]);

									colRowSpan += sd['rowspan'];

									if (lastColSpan != -1 && sd['colspan'] != lastColSpan) {
										alert("Invalid selection for merge.");
										return true;
									}

									lastColSpan = sd['colspan'];
								}

								if (colRowSpan > rowSpan)
									rowSpan = colRowSpan;

								lastColSpan = -1;
							}

							// Setup td
							tdElm = rows[0][0];
							tdElm.rowSpan = rowSpan;
							tdElm.colSpan = colSpan;

							// Merge cells
							for (var y=0; y<rows.length; y++) {
								for (var x=0; x<rows[y].length; x++) {
									var html = rows[y][x].innerHTML;
									var chk = html.replace(/[ \t\r\n]/g, "");

									if (chk != "<br/>" && chk != "<br>" && chk != '<br mce_bogus="1"/>' && (x+y > 0))
										tdElm.innerHTML += html;

									// Not current cell
									if (rows[y][x] != tdElm && !rows[y][x]._deleted) {
										var cpos = getCellPos(grid, rows[y][x]);
										var tr = rows[y][x].parentNode;

										tr.removeChild(rows[y][x]);
										rows[y][x]._deleted = true;

										// Empty TR, remove it
										if (!tr.hasChildNodes()) {
											tr.parentNode.removeChild(tr);

											var lastCell = null;
											for (var x=0; cellElm = getCell(grid, cpos.rowindex, x); x++) {
												if (cellElm != lastCell && cellElm.rowSpan > 1)
													cellElm.rowSpan--;

												lastCell = cellElm;
											}

											if (tdElm.rowSpan > 1)
												tdElm.rowSpan--;
										}
									}
								}
							}

							// Remove all but one bogus br
							each(ed.dom.select('br', tdElm), function(e, i) {
								if (i > 0 && ed.dom.getAttrib(e, 'mce_bogus'))
									ed.dom.remove(e);
							});

							break;
						}

						tableElm = inst.dom.getParent(inst.selection.getNode(), "table");
						inst.addVisual(tableElm);
						inst.nodeChanged();
					}

				return true;
			}

			// Pass to next handler in chain
			return false;
		}
	});

	// Register plugin
	tinymce.PluginManager.add('table', tinymce.plugins.TablePlugin);
})();