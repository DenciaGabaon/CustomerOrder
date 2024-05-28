<?php
                            $sql = "SELECT DISTINCT OrderID FROM `order`";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['OrderID'] . "'>" . $row['OrderID'] . "</option>";
                                }
                            }
                        ?>