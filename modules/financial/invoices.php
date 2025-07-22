<?php
$projects = DB::query("SELECT * FROM projects");
?>
<style>
    th {
        background-color: #04665f !important;
        color: white !important;
    }

    .btn-custom {
        background-color: #04665f;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #034b45;
        color: white;
    }
    
    .invoice-period-btn {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        margin: 0 0.25rem;
        border-radius: 0.25rem;
    }
    
    .invoice-period-btn.active {
        background-color: #04665f;
        color: white;
        border-color: #04665f;
    }
    
    .task-summary {
        white-space: pre-wrap;
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.25rem;
        border: 1px solid #dee2e6;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Invoices Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h2">Invoice Management</h1>
        <p class="mb-0 text-muted">View and manage all your invoices</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
                <i class="fas fa-plus me-1"></i> New Invoice
            </button>
        </div>
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown">
                <i class="fas fa-download me-1"></i> Export
            </button>
            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.handleExport('csv')"><i class="fas fa-file-csv me-2"></i> CSV</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.handleExport('excel')"><i class="fas fa-file-excel me-2"></i> Excel</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.handleExport('pdf')"><i class="fas fa-file-pdf me-2"></i> PDF</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Invoice Status Tabs -->
<ul class="nav nav-tabs mb-4" id="invoiceTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
            <i class="fas fa-list me-1"></i> All Invoices
        </button>
    </li>
</ul>

<!-- Invoice Filters -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form class="row g-3" id="invoiceFilterForm">
            <div class="col-md-4">
                <label for="clientFilter" class="form-label">Client</label>
                <select class="form-select" id="clientFilter">
                    <option value="" selected>All Clients</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dateFrom" class="form-label">From</label>
                <input type="date" class="form-control" id="dateFrom">
            </div>
            <div class="col-md-3">
                <label for="dateTo" class="form-label">To</label>
                <input type="date" class="form-control" id="dateTo">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-custom w-100">Apply</button>
            </div>
        </form>
    </div>
</div>

<!-- Invoice Content -->
<div class="tab-content" id="invoiceTabsContent">
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllInvoices">
                                    </div>
                                </th>
                                <th>Invoice #</th>
                                <th>Client</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="invoicesTableBody">
                            <!-- Will be populated dynaically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 text-muted" id="paginationInfo">Loading invoices...</p>
                    </div>
                    <nav>
                        <ul class="pagination mb-0" id="paginationControls">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Tab Panes -->
    <div class="tab-pane fade" id="paid" role="tabpanel"></div>
    <div class="tab-pane fade" id="pending" role="tabpanel"></div>
    <div class="tab-pane fade" id="overdue" role="tabpanel"></div>
    <div class="tab-pane fade" id="draft" role="tabpanel"></div>
</div>

<!-- New Invoice Modal -->
<div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-custom">
                <h5 class="modal-title text-white">Create New Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newInvoiceForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Company</label>
                            <select class="form-select" id="invoiceCompany" required>
                                <option value="">Select Company</option>
                                <option value="BixiSoft">BixiSoft (Private) Limited</option>
                                <option value="RanaMansoor">Rana Mansoor Akbar Khan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Invoice Period</label>
                            <div class="d-flex">
                                <button type="button" class="invoice-period-btn active" data-period="first">1st - 15th</button>
                                <button type="button" class="invoice-period-btn" data-period="second">16th - End</button>
                            </div>
                            <input type="hidden" id="selectedPeriod" value="first">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Client</label>
                            <select class="form-select" id="invoiceClient" required>
                                <option value="">Select Client</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Project</label>
                            <select class="form-select" id="invoiceProject" required disabled>
                                <option value="">Select Project</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" id="dateFromFilter" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" id="dateToFilter" required readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Work Summary (Auto-generated)</label>
                        <div class="task-summary" id="taskSummary">Summary will be generated based on selected tasks</div>
                    </div>

                    <h6 class="mb-3">Select Tasks to Invoice</h6>
                    <div class="table-responsive">
                        <table class="table" id="tasksTable">
                            <thead>
                                <tr>
                                    <th width="40"><input type="checkbox" id="selectAllTasks"></th>
                                    <th>Date</th>
                                    <th>Task</th>
                                </tr>
                            </thead>
                            <tbody id="tasksTableBody">
                                <!-- Will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-custom">Create Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Invoice Modal -->
<div class="modal fade" id="viewInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="invoiceDetailsContent">
                <!-- Will be populated dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printInvoiceBtn">Print</button>
                <button type="button" class="btn btn-success" id="downloadPdfBtn">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Invoice Modal -->
<div class="modal fade" id="editInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editInvoiceForm">
                    <input type="hidden" id="editInvoiceId">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Client</label>
                            <select class="form-select" id="editInvoiceClient" required>
                                <option value="">Select Client</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Project</label>
                            <select class="form-select" id="editInvoiceProject" required>
                                <option value="">Select Project</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" id="editDateFromFilter" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" id="editDateToFilter" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" id="editInvoiceNotes" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .table-responsive {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        z-index: 1000;
    }
    
    .bg-custom {
        background-color: #04665f;
        color: white;
    }
    
    /* PDF styling */
    .invoice-pdf-header {
        border-bottom: 2px solid #04665f;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    
    .invoice-pdf-title {
        color: #04665f;
        font-size: 24px;
        font-weight: bold;
    }
    
    .invoice-pdf-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .invoice-pdf-table th {
        background-color: #04665f;
        color: white;
        padding: 8px;
        text-align: left;
    }
    
    .invoice-pdf-table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    
    .invoice-pdf-total {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: right;
        padding: 10px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
// Initialize jsPDF
const { jsPDF } = window.jspdf;

document.addEventListener('DOMContentLoaded', function() {
    const invoiceManager = {
        currentTab: 'all',
        currentPage: 1,
        itemsPerPage: 10,
        totalInvoices: 0,
        filters: {},
        selectedClientId: null,
        currentCompany: null,
        companyLogos: {
            'BixiSoft': 'path/to/bixisoft-logo.png',
            'RanaMansoor': 'path/to/rana-logo.png'
        },
        
        init: function() {
            this.bindEvents();
            this.loadClients();
            this.loadInvoices();
            this.setupCompanySelection();
            this.setupPeriodButtons();
            this.updateInvoiceDates();
        },
        
        setupCompanySelection: function() {
            document.getElementById('invoiceCompany').addEventListener('change', (e) => {
                this.currentCompany = e.target.value;
                this.updateCompanyDetails();
            });
        },
        
        setupPeriodButtons: function() {
            document.querySelectorAll('.invoice-period-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.invoice-period-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('selectedPeriod').value = btn.dataset.period;
                    this.updateInvoiceDates();
                });
            });
        },
        
        updateCompanyDetails: function() {
            // Update any company-specific details
            this.updateInvoiceDates();
        },
        
        updateInvoiceDates: function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth() + 1;
            const period = document.getElementById('selectedPeriod').value;
            
            let fromDate, toDate;
            if (period === 'first') {
                fromDate = `${year}-${month.toString().padStart(2, '0')}-01`;
                toDate = `${year}-${month.toString().padStart(2, '0')}-15`;
            } else {
                fromDate = `${year}-${month.toString().padStart(2, '0')}-16`;
                const lastDay = new Date(year, month, 0).getDate();
                toDate = `${year}-${month.toString().padStart(2, '0')}-${lastDay}`;
            }
            
            document.getElementById('dateFromFilter').value = fromDate;
            document.getElementById('dateToFilter').value = toDate;
            
            if (this.selectedClientId && document.getElementById('invoiceProject').value) {
                this.loadTasksForProject(
                    this.selectedClientId,
                    document.getElementById('invoiceProject').value,
                    fromDate,
                    toDate
                );
            }
        },
        
        generatePdf: function() {
            const modalContent = document.getElementById('invoiceDetailsContent');
            const invoiceNumber = modalContent.querySelector('h4').textContent.replace('Invoice #', '');
            const doc = new jsPDF();
            
            // Add company header
            if (this.currentCompany === 'BixiSoft') {
                // Add BixiSoft header with logo
                doc.addImage(this.companyLogos.BixiSoft, 'PNG', 15, 15, 40, 40);
                doc.setFontSize(18);
                doc.setTextColor(4, 102, 95);
                doc.text('BixiSoft (Private) Limited', 105, 25, { align: 'center' });
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);
                doc.text('183 - WestWood Colony, Lahore, Punjab, Pakistan', 105, 33, { align: 'center' });
                doc.text('+923333414777', 105, 39, { align: 'center' });
            } else {
                // Add Rana Mansoor header with logo
                doc.addImage(this.companyLogos.RanaMansoor, 'PNG', 15, 15, 40, 40);
                doc.setFontSize(18);
                doc.setTextColor(4, 102, 95);
                doc.text('Rana Mansoor Akbar Khan', 105, 25, { align: 'center' });
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);
                doc.text('Al-Sadeeq Akbar, Chak No 100/M, Bahawalpur Road, Lodhran, PK', 105, 33, { align: 'center' });
                doc.text('Senior PHP Developer, Project Manager, Systems Analyst', 105, 39, { align: 'center' });
            }
            
            // Invoice title and details
            doc.setFontSize(16);
            doc.setTextColor(4, 102, 95);
            doc.text(`INVOICE #${invoiceNumber}`, 105, 55, { align: 'center' });
            
            doc.setFontSize(10);
            doc.setTextColor(0, 0, 0);
            doc.text(`Date Range: ${document.getElementById('dateFromFilter').value} to ${document.getElementById('dateToFilter').value}`, 14, 65);
            
            // Client information
            const clientName = modalContent.querySelector('.text-end h4').textContent;
            const clientAddress = modalContent.querySelector('.text-end p:nth-child(2)').textContent;
            const clientPhone = modalContent.querySelector('.text-end p:nth-child(3)').textContent;
            const clientEmail = modalContent.querySelector('.text-end p:nth-child(4)').textContent;
            
            doc.setFontSize(12);
            doc.text(`Invoice for: ${clientName}`, 14, 75);
            doc.text(clientAddress, 14, 82);
            doc.text(clientPhone, 14, 89);
            doc.text(clientEmail, 14, 96);
            
            // Invoice items
            let yPos = 110;
            doc.setFillColor(4, 102, 95);
            doc.setTextColor(255, 255, 255);
            doc.rect(14, yPos - 10, 180, 10, 'F');
            doc.text('Date', 20, yPos - 4);
            doc.text('Task', 60, yPos - 4);
            doc.text('Description', 120, yPos - 4);
            
            yPos += 5;
            doc.setFontSize(10);
            doc.setTextColor(0, 0, 0);
            
            const items = modalContent.querySelectorAll('tbody tr');
            items.forEach(item => {
                const cols = item.querySelectorAll('td');
                const date = cols[0].textContent;
                const task = cols[1].textContent;
                const description = cols[2].textContent;
                
                doc.text(date, 20, yPos);
                doc.text(task, 60, yPos);
                doc.text(description, 120, yPos, { maxWidth: 70 });
                
                yPos += 10;
                if (yPos > 270) {
                    doc.addPage();
                    yPos = 20;
                }
            });
            
            // Total amount
            const totalAmount = modalContent.querySelector('.text-success').textContent;
            yPos += 20;
            doc.setFontSize(12);
            doc.text('Total Amount:', 140, yPos);
            doc.text(totalAmount, 180, yPos, { align: 'right' });
            
            // Save PDF
            doc.save(`Invoice_${invoiceNumber}.pdf`);
        },

            updateFilters: function() {
                const form = document.getElementById('invoiceFilterForm');
                this.filters = {
                    client_id: form.querySelector('#clientFilter').value,
                    date_from: form.querySelector('#dateFrom').value,
                    date_to: form.querySelector('#dateTo').value,
                    status: this.currentTab === 'all' ? '' : this.currentTab
                };
            },

            loadClients: function() {
                fetch('ajax_helpers/getClients.php')
                    .then(response => response.json())
                    .then(clients => {
                        const clientFilter = document.getElementById('clientFilter');
                        const invoiceClient = document.getElementById('invoiceClient');
                        const editInvoiceClient = document.getElementById('editInvoiceClient');

                        // Clear existing options
                        clientFilter.innerHTML = '<option value="">All Clients</option>';
                        invoiceClient.innerHTML = '<option value="">Select Client</option>';
                        editInvoiceClient.innerHTML = '<option value="">Select Client</option>';

                        clients.forEach(client => {
                            const fullName = `${client.first_name} ${client.last_name}`;

                            // For client filter dropdown
                            const option1 = document.createElement('option');
                            option1.value = client.id;
                            option1.textContent = fullName;
                            clientFilter.appendChild(option1);

                            // For new invoice client dropdown
                            const option2 = document.createElement('option');
                            option2.value = client.id;
                            option2.textContent = fullName;
                            invoiceClient.appendChild(option2);

                            // For edit invoice client dropdown
                            const option3 = document.createElement('option');
                            option3.value = client.id;
                            option3.textContent = fullName;
                            editInvoiceClient.appendChild(option3);
                        });
                    })
                    .catch(error => console.error('Error loading clients:', error));
            },

            loadProjectsForClient: function(clientId) {
                if (!clientId) {
                    document.getElementById('invoiceProject').disabled = true;
                    document.getElementById('invoiceProject').innerHTML = '<option value="">Select Project</option>';
                    document.getElementById('tasksTableBody').innerHTML = '';
                    return;
                }

                fetch(`ajax_helpers/getProjects.php?client_id=${clientId}`)
                    .then(response => response.json())
                    .then(projects => {
                        const projectSelect = document.getElementById('invoiceProject');
                        projectSelect.innerHTML = '<option value="">Select Project</option>';
                        projectSelect.disabled = false;

                        projects.forEach(project => {
                            const option = document.createElement('option');
                            option.value = project.id;
                            option.textContent = `${project.name} (Rate: ${project.rate})`;
                            option.dataset.rate = project.rate;
                            projectSelect.appendChild(option);
                        });

                        // In the loadProjectsForClient method, update the project select change handler:
                        projectSelect.addEventListener('change', (e) => {
                            if (e.target.value) {
                                const fromDate = document.getElementById('dateFromFilter').value;
                                const toDate = document.getElementById('dateToFilter').value;

                                if (fromDate && toDate) {
                                    this.loadTasksForProject(clientId, e.target.value, fromDate, toDate);
                                } else {
                                    document.getElementById('tasksTableBody').innerHTML =
                                        '<tr><td colspan="7" class="text-center py-4 text-muted">Please select both From and To dates</td></tr>';
                                }
                            } else {
                                document.getElementById('tasksTableBody').innerHTML = '';
                            }
                        });
                    })
                    .catch(error => console.error('Error loading projects:', error));
            },

              loadTasksForProject: function(clientId, projectId, fromDate, toDate) {
            // Validate dates
            if (!fromDate || !toDate) {
                document.getElementById('tasksTableBody').innerHTML =
                    '<tr><td colspan="3" class="text-center py-4 text-muted">Please select both From and To dates</td></tr>';
                return;
            }

            const tbody = document.getElementById('tasksTableBody');
            tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4">Loading tasks...</td></tr>';

            const url = `ajax_helpers/getTasks.php?project_id=${projectId}&start_date=${fromDate}&end_date=${toDate}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    tbody.innerHTML = '';
                    let taskList = [];

                    if (data && data.length > 0) {
                        data.forEach(task => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>
                                    <input type="checkbox" class="form-check-input task-checkbox" 
                                        data-task_id="${task.id}">
                                </td>
                                <td>${task.task_date || ''}</td>
                                <td>${task.title || ''}</td>
                            `;
                            tbody.appendChild(row);
                            
                            // Add to task list for summary
                            if (task.title) {
                                taskList.push(task.title);
                            }
                        });
                        
                        // Generate summary
                        this.generateTaskSummary(taskList);
                    } else {
                        tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-muted">No tasks found for this project in the selected date range</td></tr>';
                        document.getElementById('taskSummary').textContent = 'No tasks available for summary';
                    }
                })
                .catch(error => {
                    console.error('Error loading tasks:', error);
                    tbody.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-danger">Error loading tasks: ${error.message}</td></tr>`;
                    document.getElementById('taskSummary').textContent = 'Error loading tasks';
                });
        },
        
        generateTaskSummary: function(taskList) {
            // Simple summary generation - you can replace this with an API call if needed
            let summary = "Work performed during this period includes:\n\n";
            
            // Group similar tasks
            const taskCounts = {};
            taskList.forEach(task => {
                const simplifiedTask = task.replace(/^\d{4}-\d{2}-\d{2}\s*/, '') // Remove dates
                                          .replace(/^\d{1,2}(?:st|nd|rd|th)\s+\w+\s+\d{4}\s*/, '') // Remove "25th Jan 2025"
                                          .trim();
                
                if (simplifiedTask) {
                    taskCounts[simplifiedTask] = (taskCounts[simplifiedTask] || 0) + 1;
                }
            });
            
            // Add to summary
            for (const [task, count] of Object.entries(taskCounts)) {
                summary += `• ${task} (${count} ${count === 1 ? 'time' : 'times'})\n`;
            }
            
            document.getElementById('taskSummary').textContent = summary;
        },
        

            loadInvoices: function() {
                const tbody = document.getElementById('invoicesTableBody');
                tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4">Loading invoices...</td></tr>';

                const params = new URLSearchParams({
                    page: this.currentPage,
                    per_page: this.itemsPerPage,
                    status: this.currentTab === 'all' ? '' : this.currentTab,
                    ...this.filters
                });

                fetch(`ajax_helpers/getInvoices.php?${params.toString()}`)
                    .then(response => response.json())
                    .then(data => {
                        this.totalInvoices = data.total;
                        this.renderInvoices(data.invoices);
                        this.updatePagination();
                    })
                    .catch(error => {
                        tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-danger">Error loading invoices</td></tr>';
                    });
            },

            renderInvoices: function(invoices) {
                const tbody = document.getElementById('invoicesTableBody');
                tbody.innerHTML = '';

                if (invoices.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-muted">No invoices found</td></tr>';
                    return;
                }

                invoices.forEach(invoice => {
                    const row = document.createElement('tr');
                    const dateRange = `${new Date(invoice.date_from).toLocaleDateString()} - ${new Date(invoice.date_to).toLocaleDateString()}`;

                    let statusBadge;
                    switch (invoice.status) {
                        case 'paid':
                            statusBadge = '<span class="badge bg-success">Paid</span>';
                            break;
                        case 'pending':
                            statusBadge = '<span class="badge bg-primary">Pending</span>';
                            break;
                        case 'overdue':
                            statusBadge = '<span class="badge bg-danger">Overdue</span>';
                            break;
                        default:
                            statusBadge = '<span class="badge bg-secondary">Draft</span>';
                    }

                    const statusDropdown = `
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Change
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'draft')">Draft</a></li>
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'pending')">Pending</a></li>
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'paid')">Paid</a></li>
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'overdue')">Overdue</a></li>
                        </ul>
                    </div>
                `;

                    row.innerHTML = `
    <td><div class="form-check"><input class="form-check-input" type="checkbox" value="${invoice.id}"></div></td>
    <td>${invoice.invoice_number}</td>
    <td>${invoice.client_name}</td>
    <td>${invoice.project_name || 'N/A'}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
                ${statusBadge} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'draft')">Mark as Draft</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'pending')">Mark as Pending</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'paid')">Mark as Paid</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'overdue')">Mark as Overdue</a></li>
            </ul>
        </div>
    </td>
    <td>
        <button class="btn btn-sm btn-outline-primary me-1 view-invoice-btn" title="View" data-invoice-id="${invoice.id}">
            <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-outline-success me-1" title="Edit" onclick="invoiceManager.editInvoice(${invoice.id})">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="invoiceManager.deleteInvoice(${invoice.id})">
            <i class="fas fa-trash"></i>
        </button>
    </td>
`;
                    tbody.appendChild(row);
                });
            },

            updatePagination: function() {
                const totalPages = Math.ceil(this.totalInvoices / this.itemsPerPage);
                const pagination = document.getElementById('paginationControls');
                pagination.innerHTML = '';

                // Previous button
                const prevLi = document.createElement('li');
                prevLi.className = `page-item ${this.currentPage === 1 ? 'disabled' : ''}`;
                prevLi.innerHTML = `<a class="page-link" href="#">Previous</a>`;
                prevLi.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.loadInvoices();
                    }
                });
                pagination.appendChild(prevLi);

                // Page numbers
                const maxVisiblePages = 5;
                let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === this.currentPage ? 'active' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                    li.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.currentPage = i;
                        this.loadInvoices();
                    });
                    pagination.appendChild(li);
                }

                // Next button
                const nextLi = document.createElement('li');
                nextLi.className = `page-item ${this.currentPage === totalPages ? 'disabled' : ''}`;
                nextLi.innerHTML = `<a class="page-link" href="#">Next</a>`;
                nextLi.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (this.currentPage < totalPages) {
                        this.currentPage++;
                        this.loadInvoices();
                    }
                });
                pagination.appendChild(nextLi);

                // Update showing text
                const startItem = (this.currentPage - 1) * this.itemsPerPage + 1;
                const endItem = Math.min(this.currentPage * this.itemsPerPage, this.totalInvoices);
                document.getElementById('paginationInfo').textContent =
                    `Showing ${startItem} to ${endItem} of ${this.totalInvoices} invoices`;
            },

            createNewInvoice: function() {
                const form = document.getElementById('newInvoiceForm');
                const selectedTasks = Array.from(document.querySelectorAll('.task-checkbox:checked'))
                    .map(checkbox => checkbox.getAttribute('data-task_id'));

                if (selectedTasks.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Tasks Selected',
                        text: 'Please select at least one task',
                        confirmButtonColor: '#3085d6',
                    });
                    return;
                }

                const formData = {
                    action: 'create_invoice',
                    client_id: form.querySelector('#invoiceClient').value,
                    project_id: form.querySelector('#invoiceProject').value,
                    date_from: form.querySelector('#dateFromFilter').value,
                    date_to: form.querySelector('#dateToFilter').value,
                    notes: form.querySelector('#invoiceNotes').value,
                    task_ids: JSON.stringify(selectedTasks)
                };

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;

                // Clear any previous error messages
                const errorElements = form.querySelectorAll('.is-invalid, .invalid-feedback');
                errorElements.forEach(el => {
                    el.classList.remove('is-invalid');
                    const errorDiv = el.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv.remove();
                    }
                });

                fetch('ajax_helpers/create_New_Invoice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            // Handle form validation errors
                            if (data.errors) {
                                Object.entries(data.errors).forEach(([field, message]) => {
                                    const input = form.querySelector(`#${field}`);
                                    if (input) {
                                        input.classList.add('is-invalid');
                                        const errorDiv = document.createElement('div');
                                        errorDiv.classList.add('invalid-feedback');
                                        errorDiv.textContent = message;
                                        input.parentNode.appendChild(errorDiv);
                                    }
                                });
                                throw new Error('Form validation failed');
                            }
                            throw new Error(data.error || 'Failed to create invoice');
                        }

                        // Success case
                        const modal = bootstrap.Modal.getInstance(document.getElementById('newInvoiceModal'));
                        if (modal) {
                            modal.hide();
                        }

                        // Reset form
                        form.reset();
                        document.getElementById('tasksTableBody').innerHTML = '';
                        document.getElementById('invoiceProject').disabled = true;

                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Invoice created successfully!',
                            confirmButtonColor: '#3085d6',
                        }).then(() => {
                            // Force a full page reload after the success message is closed
                            window.location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error creating invoice:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error creating invoice: ' + (error.message || 'Please check your inputs and try again'),
                            confirmButtonColor: '#3085d6',
                        });
                    })
                    .finally(() => {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    });
            },

            viewInvoice: function(invoiceId) {
                fetch(`ajax_helpers/getInvoiceDetails.php?id=${invoiceId}`)
                    .then(response => {
                        if (response.status === 401) {
                            window.location.reload(); // Redirect to login if session expired
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            throw new Error(data.error || 'Failed to load invoice');
                        }
                        this.showInvoiceModal(data.invoice);
                    })
                    .catch(error => {
                        console.error('Error loading invoice:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error loading invoice details: ' + error,
                            confirmButtonColor: '#3085d6',
                        });
                    });
            },

    showInvoiceModal: function(invoice) {
            try {
                if (!invoice || !invoice.invoice_number) {
                    throw new Error('Invalid invoice data received');
                }

                const modalContent = document.getElementById('invoiceDetailsContent');
                
                // Format dates
                const formatDate = (dateStr) => {
                    if (!dateStr) return 'N/A';
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric' 
                    });
                };

                const dateRange = `${formatDate(invoice.date_from)} - ${formatDate(invoice.date_to)}`;

                // Status badge
                const statusBadges = {
                    paid: { class: 'bg-success', text: 'Paid' },
                    pending: { class: 'bg-primary', text: 'Pending' },
                    overdue: { class: 'bg-danger', text: 'Overdue' },
                    draft: { class: 'bg-secondary', text: 'Draft' }
                };
                const status = invoice.status || 'draft';
                const statusBadge = statusBadges[status] || statusBadges.draft;

                // Format currency
                const projectRate = parseFloat(invoice.project_rate) || 0;
                const formattedRate = projectRate.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                });

                // Generate items table
                let itemsHtml = '';
                if (invoice.items && invoice.items.length > 0) {
                    invoice.items.forEach(item => {
                        // Replace newlines with <br> in the description
                        const description = (item.details || 'No details').replace(/\n/g, '<br>');
                        
                        itemsHtml += `
                            <tr>
                                <td>${formatDate(item.date)}</td>
                                <td style="white-space: normal; word-wrap: break-word;">${item.task_title || 'No title'}</td>
                                <td style="white-space: normal; word-wrap: break-word;">${description}</td>
                            </tr>
                        `;
                    });
                } else {
                    itemsHtml = `
                        <tr>
                            <td colspan="3" class="text-center py-3 text-muted">
                                No items found for this invoice
                            </td>
                        </tr>
                    `;
                }

                // Build the modal content
                modalContent.innerHTML = `
                <div class="invoice-preview">
                    <div class="invoice-header d-flex justify-content-between mb-4">
                        <div>
                            <h4>Invoice #${invoice.invoice_number}</h4>
                            <p class="mb-1"><strong>Date Range:</strong> ${dateRange}</p>
                            <p class="mb-1"><strong>Project:</strong> ${invoice.project_name || 'N/A'}</p>
                            <p class="mb-1"><strong>Status:</strong> <span class="badge ${statusBadge.class}">${statusBadge.text}</span></p>
                        </div>
                        <div class="text-end">
                            <h4>${invoice.client_name || 'No client specified'}</h4>
                            <p class="mb-1">${invoice.client_info?.address || ''}</p>
                            <p class="mb-1">Phone: ${invoice.client_info?.phone || 'N/A'}</p>
                            <p class="mb-1">Email: ${invoice.client_info?.email || 'N/A'}</p>
                        </div>
                    </div>
                    
                    <div class="invoice-summary mb-4">
                        <h5 class="mb-3">Work Summary</h5>
                        <div class="bg-light p-3 rounded mb-3">
                            <p class="mb-0">${invoice.notes || 'No summary provided'}</p>
                        </div>
                        
                        <h5 class="mb-3">Invoice Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="table-layout: fixed;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 15%">Date</th>
                                        <th style="width: 30%">Task</th>
                                        <th style="width: 55%">Description</th>
                                    </tr>
                                </thead>
                                <tbody>${itemsHtml}</tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <div class="bg-light p-3 rounded" style="min-width:300px;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Project Rate:</span>
                                    <span>${formattedRate}</span>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total Amount:</span>
                                    <span class="fs-5 fw-bold text-success">${formattedRate}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                const modal = new bootstrap.Modal(document.getElementById('viewInvoiceModal'));
                modal.show();

            } catch (error) {
                console.error('Error displaying invoice:', error);
                document.getElementById('invoiceDetailsContent').innerHTML = `
                <div class="alert alert-danger">
                    <h4>Error Displaying Invoice</h4>
                    <p>${error.message}</p>
                    <p>Please check the console for more details.</p>
                    <button class="btn btn-sm btn-secondary" onclick="window.location.reload()">
                        Reload Page
                    </button>
                </div>
                `;
                new bootstrap.Modal(document.getElementById('viewInvoiceModal')).show();
            }
        },


            showEditModal: function(invoice) {
                document.getElementById('editInvoiceId').value = invoice.id;
                document.getElementById('editInvoiceClient').value = invoice.client_id;

                document.getElementById('editDateFromFilter').value = invoice.date_from ? invoice.date_from.split('T')[0] : '';
                document.getElementById('editDateToFilter').value = invoice.date_to ? invoice.date_to.split('T')[0] : '';

                document.getElementById('editInvoiceNotes').value = invoice.notes || '';

                const clientSelect = document.getElementById('editInvoiceClient');
                clientSelect.addEventListener('change', (e) => {
                    this.loadProjectsForEditModal(e.target.value);
                });

                const modal = new bootstrap.Modal(document.getElementById('editInvoiceModal'));
                modal.show();

                document.getElementById('editInvoiceForm').onsubmit = (e) => {
                    e.preventDefault();
                    this.updateInvoice(invoice.id);
                };
            },

            loadClientsForEditModal: function() {
                return fetch('ajax_helpers/getClients.php')
                    .then(response => response.json())
                    .then(clients => {
                        const clientSelect = document.getElementById('editInvoiceClient');
                        clientSelect.innerHTML = '<option value="">Select Client</option>';

                        clients.forEach(client => {
                            const option = document.createElement('option');
                            option.value = client.id;
                            option.textContent = `${client.first_name} ${client.last_name}`;
                            clientSelect.appendChild(option);
                        });

                        return clients;
                    });
            },

            loadProjectsForEditModal: function(clientId, selectedProjectId = null) {
                if (!clientId) {
                    document.getElementById('editInvoiceProject').innerHTML = '<option value="">Select Project</option>';
                    document.getElementById('editInvoiceProject').disabled = true;
                    return;
                }

                return fetch(`ajax_helpers/getProjects.php?client_id=${clientId}`)
                    .then(response => response.json())
                    .then(projects => {
                        const projectSelect = document.getElementById('editInvoiceProject');
                        projectSelect.innerHTML = '<option value="">Select Project</option>';
                        projectSelect.disabled = false;

                        projects.forEach(project => {
                            const option = document.createElement('option');
                            option.value = project.id;
                            option.textContent = project.name;
                            if (selectedProjectId && project.id == selectedProjectId) {
                                option.selected = true;
                            }
                            projectSelect.appendChild(option);
                        });
                    });
            },

            updateInvoice: function(invoiceId) {
                const form = document.getElementById('editInvoiceForm');
                const formData = {
                    action: 'update_invoice',
                    id: invoiceId,
                    client_id: form.querySelector('#editInvoiceClient').value,
                    project_id: form.querySelector('#editInvoiceProject').value,
                    date_from: form.querySelector('#editDateFromFilter').value,
                    date_to: form.querySelector('#editDateToFilter').value,
                    notes: form.querySelector('#editInvoiceNotes').value
                };

                fetch('ajax_helpers/updateInvoice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            bootstrap.Modal.getInstance(document.getElementById('editInvoiceModal')).hide();
                            this.loadInvoices();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Invoice updated successfully!',
                                confirmButtonColor: '#3085d6',
                            });
                        } else {
                            throw new Error(data.error || 'Failed to update invoice');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating invoice: ' + error.message,
                            confirmButtonColor: '#3085d6',
                        });
                    });
            },

            sendInvoice: function(invoiceId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to send invoice #${invoiceId} to the client?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, send it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`ajax_helpers/sendInvoice.php?id=${invoiceId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sent!',
                                        text: 'Invoice sent successfully',
                                        confirmButtonColor: '#3085d6',
                                    });
                                    this.loadInvoices();
                                } else {
                                    throw new Error(data.error || 'Failed to send invoice');
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error sending invoice: ' + error.message,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                    }
                });
            },

            updateStatus: function(invoiceId, newStatus) {
                console.log(`Attempting to update invoice ${invoiceId} to status ${newStatus}`); // Debug log

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to change this invoice's status to ${newStatus}`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('User confirmed status change'); // Debug log

                        fetch('ajax_helpers/updateInvoiceStatus.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams({
                                    invoice_id: invoiceId,
                                    new_status: newStatus
                                })
                            })
                            .then(response => {
                                console.log('Received response from server'); // Debug log
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Response data:', data); // Debug log
                                if (data.success) {
                                    this.loadInvoices();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Updated!',
                                        text: 'Invoice status updated successfully',
                                        confirmButtonColor: '#3085d6',
                                    });
                                } else {
                                    throw new Error(data.error || 'Failed to update status');
                                }
                            })
                            .catch(error => {
                                console.error('Error updating status:', error); // Debug log
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error updating status: ' + error.message,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                    }
                });
            },

            deleteInvoice: function(invoiceId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`ajax_helpers/deleteInvoice.php?id=${invoiceId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Invoice deleted successfully',
                                        confirmButtonColor: '#3085d6',
                                    });
                                    this.loadInvoices();
                                } else {
                                    throw new Error(data.error || 'Failed to delete invoice');
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error deleting invoice: ' + error.message,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                    }
                });
            }
        };

        invoiceManager.init();
        window.invoiceManager = invoiceManager;
    });
</script>