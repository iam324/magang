        // Function to show section - Enhanced version with event listeners
        function showSection(sectionName) {
            console.log('=== showSection called ===');
            console.log('Section name:', sectionName);
            
            try {
                // Remove active from all nav links
                const allLinks = document.querySelectorAll('.sidebar .nav-link');
                console.log('Found nav links:', allLinks.length);
                
                allLinks.forEach(function(link) {
                    link.classList.remove('active');
                });

                // Add active to clicked link
                const activeLink = document.querySelector('[data-section="' + sectionName + '"]');
                if (activeLink) {
                    activeLink.classList.add('active');
                    console.log('Active link updated');
                } else {
                    console.warn('Active link not found for:', sectionName);
                }

                // Hide all sections
                const allSections = document.querySelectorAll('.content-section');
                console.log('Found sections:', allSections.length);
                
                allSections.forEach(function(section) {
                    section.classList.remove('active');
                    section.style.display = 'none';
                });

                // Show selected section
                const targetSection = document.getElementById(sectionName + '-section');
                if (targetSection) {
                    targetSection.classList.add('active');
                    targetSection.style.display = 'block';
                    console.log('✅ Section displayed:', sectionName);
                    
                    // Scroll to top
                    window.scrollTo(0, 0);
                } else {
                    console.error('❌ Section not found:', sectionName + '-section');
                }
            } catch (error) {
                console.error('Error in showSection:', error);
            }
            
            return false;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== Admin panel initializing ===');
            
            // Add click event listeners to all navigation links
            const navLinks = document.querySelectorAll('[data-section]');
            console.log('Setting up event listeners for', navLinks.length, 'links');
            
            navLinks.forEach(function(link) {
                const section = link.getAttribute('data-section');
                
                // Add event listener
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Link clicked:', section);
                    showSection(section);
                    return false;
                });
                
                console.log('Event listener added for:', section);
            });

            // Check URL parameters for section
            const urlParams = new URLSearchParams(window.location.search);
            const section = urlParams.get('section');

            if (section) {
                console.log('Opening section from URL:', section);
                setTimeout(function() {
                    showSection(section);
                }, 100);
            } else {
                // Show dashboard by default
                setTimeout(function() {
                    showSection('dashboard');
                }, 100);
            }
            
            console.log('=== Admin panel initialized ===');
        });

        // Function to show delete confirmation modal
        function confirmDelete(newsId, newsTitle, csrfToken) {
            // Set the news ID in the hidden input
            document.getElementById('deleteNewsId').value = newsId;
            // Set the news title in the modal
            document.getElementById('newsTitle').textContent = newsTitle;
            // Set the CSRF token in the hidden input
            document.getElementById('deleteCsrfToken').value = csrfToken;
            // Show the modal
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Function to show registration detail in modal
        function showRegistrationDetail(data, age) {
            // Fill child data
            document.getElementById('detail-child-name').textContent = data.name || '-';
            
            if (data.dob) {
                const dobDate = new Date(data.dob);
                const formattedDob = dobDate.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
                document.getElementById('detail-child-dob').textContent = formattedDob;
                document.getElementById('detail-child-age').innerHTML = age ? `<span class="badge bg-info">${age} tahun</span>` : '-';
            } else {
                document.getElementById('detail-child-dob').textContent = '-';
                document.getElementById('detail-child-age').textContent = '-';
            }
            
            // Fill parent data
            document.getElementById('detail-parent-name').textContent = data.parent_name || '-';
            document.getElementById('detail-parent-email').textContent = data.email || '-';
            document.getElementById('detail-parent-phone').textContent = data.phone || '-';
            
            // Fill address
            document.getElementById('detail-address').textContent = data.address || '-';
            
            // Fill message (show/hide section)
            if (data.message && data.message.trim() !== '') {
                document.getElementById('detail-message').textContent = data.message;
                document.getElementById('detail-message-section').style.display = 'block';
            } else {
                document.getElementById('detail-message-section').style.display = 'none';
            }
            
            // Fill status
            let statusBadge = '';
            if (data.status === 'pending') {
                statusBadge = '<span class="badge bg-warning">Pending</span>';
            } else if (data.status === 'approved') {
                statusBadge = '<span class="badge bg-success">Approved</span>';
            } else if (data.status === 'rejected') {
                statusBadge = '<span class="badge bg-danger">Rejected</span>';
            }
            document.getElementById('detail-status').innerHTML = statusBadge;
            
            // Fill created date
            if (data.created_at) {
                const createdDate = new Date(data.created_at);
                const formattedDate = createdDate.toLocaleString('id-ID', { 
                    day: '2-digit', 
                    month: '2-digit', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('detail-created-at').textContent = formattedDate;
            }
            
            // Show/hide action buttons based on status
            const actionButtonsDiv = document.getElementById('detail-action-buttons');
            if (data.status === 'pending') {
                actionButtonsDiv.innerHTML = `
                    <button type="button" class="btn btn-success me-2" onclick="approveRegistration(${data.id}); bootstrap.Modal.getInstance(document.getElementById('registrationDetailModal')).hide();">
                        <i class="fas fa-check"></i> Setujui Pendaftaran
                    </button>
                    <button type="button" class="btn btn-danger me-2" onclick="rejectRegistration(${data.id}); bootstrap.Modal.getInstance(document.getElementById('registrationDetailModal')).hide();">
                        <i class="fas fa-times"></i> Tolak Pendaftaran
                    </button>
                `;
            } else {
                actionButtonsDiv.innerHTML = `
                    <button type="button" class="btn btn-danger me-2" onclick="deleteRegistration(${data.id}); bootstrap.Modal.getInstance(document.getElementById('registrationDetailModal')).hide();">
                        <i class="fas fa-trash"></i> Hapus Data
                    </button>
                `;
            }
            
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('registrationDetailModal'));
            modal.show();
        }

        // Function to show success modal
        function showSuccessModal(title, message) {
            document.getElementById('successTitle').textContent = title;
            document.getElementById('successMessage').textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
        }

        // Function to show error modal
        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('errorModal'));
            modal.show();
        }

        // Function to approve registration
        function approveRegistration(id) {
            const csrfToken = document.getElementById('globalCsrfToken').value;
            fetch('update_registration_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&status=approved&csrf_token=' + csrfToken
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    showSuccessModal('Pendaftaran Disetujui!', 'Pendaftaran berhasil disetujui. Status telah diupdate.');
                } else {
                    showErrorModal('Gagal menyetujui pendaftaran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Terjadi kesalahan saat memproses permintaan');
            });
        }

        // Function to reject registration
        function rejectRegistration(id) {
            const csrfToken = document.getElementById('globalCsrfToken').value;
            fetch('update_registration_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&status=rejected&csrf_token=' + csrfToken
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    showSuccessModal('Pendaftaran Ditolak!', 'Pendaftaran berhasil ditolak. Status telah diupdate.');
                } else {
                    showErrorModal('Gagal menolak pendaftaran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Terjadi kesalahan saat memproses permintaan');
            });
        }

        // Function to delete registration (show confirmation modal)
        function deleteRegistration(id) {
            document.getElementById('deleteRegistrationId').value = id;
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteRegistrationModal'));
            modal.show();
        }

        // Function to confirm delete registration
        function confirmDeleteRegistration() {
            const id = document.getElementById('deleteRegistrationId').value;
            const csrfToken = document.getElementById('globalCsrfToken').value;
            
            fetch('delete_registration.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&csrf_token=' + csrfToken
            })
            .then(response => response.json())
            .then(data => {
                // Close confirmation modal
                bootstrap.Modal.getInstance(document.getElementById('confirmDeleteRegistrationModal')).hide();
                
                if(data.success) {
                    showSuccessModal('Data Dihapus!', 'Data pendaftaran berhasil dihapus dari sistem.');
                } else {
                    showErrorModal('Gagal menghapus data: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                bootstrap.Modal.getInstance(document.getElementById('confirmDeleteRegistrationModal')).hide();
                showErrorModal('Terjadi kesalahan saat menghapus data');
            });
        }