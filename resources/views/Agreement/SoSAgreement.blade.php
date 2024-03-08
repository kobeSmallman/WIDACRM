{{-- SoSAgreement.blade.php --}}
<x-layout>
    <div class="container mt-4">
        <h2>Scope of Service Agreement</h2>
        <form action="{{ route('agreement.store') }}" method="POST">
            @csrf

        <div class="form-group">
            <h4>1. THE PARTIES</h4>
            <p>This Agreement is made effective as of <input type="date" name="effective_date" required>, by and between:</p>
            <p>Consultant: WIDA Procurement & Supply Chain Solutions Ltd. with a mailing address of <input type="text" name="consultant_address" value="3215E 16 Ave N, Lethbridge, AB T1H 5E8" required>;</p>
            <p>Client: <input type="text" name="client_name" placeholder="Client Name" required> with a mailing address of <input type="text" name="client_address" placeholder="Client Address" required>.</p>
        </div>

        <div class="form-group">
            <h4>2. SERVICES</h4>
            <p>Consultant agrees to provide the services selected in Schedule “A” attached hereto (the "Services"). 
                The Client agrees that, during the Term of this Agreement, the Consultant shall be the sole and 
                excusive provider of the Services, except where the Client has already entered into an agreement 
                with a third party for the provision of the same or similar services, in which case the Client 
                shall be at liberty to contract with the Consultant or any third party for the provision of the 
                Services or similar services.</p>
        </div>


        <div class="form-group">
            <h4>3. TERM</h4>
            <p>The Services shall commence on <input type="date" name="services_commence_date" required>, and end:</p>
            <div>
                <input type="radio" id="end_date" name="term_end" value="date">
                <label for="end_date">On the date of</label> <input type="date" name="end_date" disabled><br>
                <input type="radio" id="completion" name="term_end" value="completion">
                <label for="completion">At completion of the Services performed</label><br>
                <input type="radio" id="other_end" name="term_end" value="other">
                <label for="other_end">Other:</label> <input type="text" name="other_end" disabled>
            </div>
        </div>

        <div class="form-group">
            <h4>4. PURCHASE ORDERS</h4>
            <p>For any specific products the Client wishes to order, the Client shall be required to place 
                such order by completing and providing the Consultant with a Purchase Order in the form 
                set out in Schedule “B” attached hereto (a “Purchase Order”). The Purchase Order shall 
                include an estimate for the Associated Costs as well as an estimate for the number of 
                hours required to complete the Quality Assurance Services as set out in Schedule “A”. 
                These estimates are provided only for the purpose of providing the Client with an estimation 
                of the total costs of any Purchase Order but are in no way a guarantee of that total cost. 
                The Client hereby acknowledges that Product Costs and Associated Costs are variable and 
                subject to change and that the total number of hours required to complete the 
                Quality Assurance Services shall be dependent upon the type of product ordered and the 
                number of defects in any given order as well as other factors. </p>
        </div>

        <div class="form-group">
            <h4>5. COMPENSATION FOR SERVICES</h4>
            <div>
                <input type="checkbox" id="per_hour" name="compensation[]" value="per_hour">
                <label for="per_hour">Per Hour, based on the hourly rate set out for the Services in Schedule “A”.</label><br>
                <input type="checkbox" id="per_order" name="compensation[]" value="per_order">
                <label for="per_order">Per Purchase Order. Amount for the completion of said order is $</label><input type="text" name="per_order_amount" placeholder="Amount"><br>
                <input type="checkbox" id="per_service_order" name="compensation[]" value="per_service_order">
                <label for="per_service_order">Per Service Order. Amount for the completion of said service is $</label><input type="text" name="per_service_order_amount" placeholder="Amount"><br>
                <input type="checkbox" id="other_compensation" name="compensation[]" value="other">
                <label for="other_compensation">Other:</label> <input type="text" name="other_compensation_details">
            </div>
        </div>

        <div class="form-group">
            <h4>6. PRODUCT AND ASSOCIATED COSTS</h4>
                <p>Costs for products sourced for clients (“Product Costs”) and associated costs including 
                    but not limited to, freight/3rd party logistics, import duty, taxes, and exchange rates 
                    (the “Associated Costs”) are variable and subject to change. Therefore, invoices for Product 
                    Costs and Associated Costs will be billed separately and must be paid in advance, upon 
                    invoice, for the order to be processed. Any invoices for Product Costs and/or Associated 
                    Costs not paid upon delivery of invoice are subject to increases due to the variable 
                    nature of the costs.</p>
        </div>

        <div class="form-group">
            <h4>7. INTEREST</h4>
            <p>Any invoices for Associated Costs not paid within seven (7) days of delivery of the 
                invoice shall incur interest at the rate of 
                x% per annum, calculated daily and compounded monthly. Any invoices for Services 
                provided or Product Costs not paid within thirty (30) days of delivery of the 
                invoice shall incur interest at the rate of 
                x% per annum, calculated daily and compounded monthly. The Client shall reimburse 
                the Consultant for all costs incurred in collecting any late payments, including 
                but not limited to, legal fees, on a solicitor-client basis.</p>
        </div>

        <div class="form-group">
            <h4>8. PAYMENT METHOD</h4>
            <p>Consultant shall be paid in accordance with section 5 in the following manner: (check all that apply)</p>
            <div>
                <input type="checkbox" id="payment_weekly" name="payment_frequency[]" value="weekly">
                <label for="payment_weekly">On a weekly basis beginning on</label> <input type="date" name="payment_start_date_weekly"><br>
                
                <input type="checkbox" id="payment_monthly" name="payment_frequency[]" value="monthly">
                <label for="payment_monthly">On a monthly basis beginning on</label> <input type="date" name="payment_start_date_monthly"><br>
                
                <input type="checkbox" id="payment_quarterly" name="payment_frequency[]" value="quarterly">
                <label for="payment_quarterly">On a quarterly basis beginning on</label> <input type="date" name="payment_start_date_quarterly"><br>
                
                <input type="checkbox" id="payment_completion" name="payment_frequency[]" value="completion">
                <label for="payment_completion">At completion of the Services performed</label><br>
                
                <input type="checkbox" id="payment_invoice" name="payment_frequency[]" value="invoice">
                <label for="payment_invoice">Upon the Client receiving an Invoice from the Consultant</label><br>
                
                <input type="checkbox" id="payment_other" name="payment_frequency[]" value="other">
                <label for="payment_other">Other:</label> <input type="text" name="payment_method_other_details"><br>
            </div>

            <div>
                <p>Payments for the Services and for any other invoices shall be made by way of:</p>
                <input type="checkbox" id="payment_bank_eft" name="payment_method[]" value="bank_eft">
                <label for="payment_bank_eft">Bank EFT</label>
                
                <input type="checkbox" id="payment_interac" name="payment_method[]" value="interac">
                <label for="payment_interac">Interac E-Transfer</label><br>
            </div>
        </div>

        <div class="form-group">
            <h4>9. RETAINER</h4>
            <p>The Client is: (check one)</p>
            <div>
             <input type="checkbox" id="retainer_required" name="retainer_required" value="1" onchange="toggleRetainerAmount(this)">
             <label for="retainer_required">Required to pay a Retainer. </label>The Client is required to pay a Retainer in the amount of $
             <input type="number" id="retainer_amount" name="retainer_amount" placeholder="Amount" disabled>
             to the Consultant as an advance on future Services to be provided ("Retainer").
            </div>
            <div>
                The Retainer is: <br>
                <input type="radio" id="retainer_refundable" name="retainer_type" value="refundable" enabled>
                <label for="retainer_refundable">Refundable</label><br>
                
                <input type="radio" id="retainer_non_refundable" name="retainer_type" value="non_refundable" enabled checked>
                <label for="retainer_non_refundable">Non-Refundable</label>
            </div>
        </div>

        <div class="form-group">
            <h4>10. CONTINGENCY</h4>
            <p>As part of the Consultant's Pay: (check one)</p>
            <div>
                <input type="radio" id="contingency_yes" name="contingency" value="yes">
                <label for="contingency_yes">There SHALL be a contingency-fee arrangement in accordance with: </label><br>
                <div style="margin-left: 20px;">
                    <input type="checkbox" name="contingency_fee_type" value="percentage" aria-label="Percentage based fee">
                    <input type="number" name="contingency_fee_percentage" placeholder="%" style="width: 80px;"> of
                    <input type="text" name="contingency_fee_percentage_description" placeholder="Description">
                </div>
                <div style="margin-left: 20px;">
                    <input type="checkbox" name="contingency_fee_type" value="flat_fee" aria-label="Flat fee">
                    Flat fee of $<input type="number" name="contingency_fee_flat_amount" placeholder="Amount" style="width: 100px;"> for the following:
                    <input type="text" name="contingency_fee_flat_description" placeholder="Description">
                </div>
                
                <input type="radio" id="contingency_no" name="contingency" value="no">
                <label for="contingency_no">There SHALL NOT be a contingency-fee arrangement</label><br>
            </div>
        </div>

        <div class="form-group">
            <h4>11. FORCE MAJEURE.</h4>
                <p>No party shall be liable or responsible to the other party, nor be deemed to have defaulted 
                    under or breached this Agreement, for any failure or delay in fulfilling or performing any 
                    term of this Agreement (except for any obligations to make payments to the other party hereunder), 
                    when and to the extent such party's ("Impacted Party") failure or delay is caused by or results 
                    from the following force majeure events ("Force Majeure Event(s)"): (a) acts of God; 
                    (b) flood, tsunami, fire, earthquake, explosion, or road closures due to any of the 
                    aforementioned; (c) epidemics, pandemics, including the 2019 novel coronavirus pandemic 
                    (COVID-19), and/or any related governmental or health authority regulations; 
                    (d) war, invasion, hostilities (whether war is declared or not), terrorist threats or acts, 
                    riot, or other civil unrest; (e) government order, law or actions; (f) embargoes or 
                    blockades in effect on or after the date of this Agreement; (g) national or regional emergency; 
                    (h) strikes, lockouts, labour stoppages or slowdowns, labour disputes, disruptions to the 
                    supply chain, or other industrial disturbances; (i) shortage of adequate power or 
                    telecommunications or transportation facilities; (j) failure of any governmental or 
                    public authority to grant a necessary licence or consent; and (k) other similar events 
                    beyond the reasonable control of the Impacted Party. The Impacted Party shall give notice 
                    within three (3) days of the Force Majeure Event to the other party, stating the period of 
                    time the occurrence is expected to continue. The Impacted Party shall use diligent efforts 
                    to end the failure or delay and ensure the effects of such Force Majeure Event are minimized. 
                    The Impacted Party shall resume the performance of its obligations as soon as reasonably 
                    practicable after the removal of the cause.</p>
        </div>

        <div class="form-group">
            <h4>12. ASSIGNMENT AND DELEGATION.</h4>
                <p>The Consultant may assign rights and may delegate duties under this Agreement to other individuals
                     or entities acting as a subcontractor ("Subcontractor"). The Consultant recognizes that they shall 
                     be liable for all work performed by the Subcontractor and shall hold the Client harmless of any 
                     liability in connection with their performed work.</p>

                <p>The Consultant shall be responsible for any confidential or proprietary information that is shared 
                    with the Subcontractor in accordance with this section. If any such information is shared by the 
                    Subcontractor to third (3rd) parties, the Consultant shall be made liable.
                </p>
        </div>

        <div class="form-group">
            <h4>13. RELATIONSHIP OF THE PARTIES.</h4>
                <p>
                The relationship between the parties is that of independent contractors. Nothing contained in this 
                Agreement shall be construed as creating any agency, partnership, joint venture or other form of 
                joint enterprise, employment, or fiduciary relationship between the parties, and neither party 
                shall have authority to contract for or bind the other party in any manner whatsoever.
                </p>
        </div>

        <div class="form-group">
            <h4>14. NOTICES</h4>
                <p>Each Party shall deliver all notices, requests, consents, claims, demands, waivers, and other 
                    communications under this Agreement (each, a "Notice") in writing and addressed to the parties' 
                    authorized representatives, as listed below (the “Authorized Representative's), at the addresses 
                    listed below (or to such other address that may be designated by the receiving party from time 
                    to time in accordance with this section). Notices sent in accordance with this section will be 
                    conclusively deemed validly and effectively given upon the sender's receipt of an acknowledgment 
                    from the intended recipient such as by the "read receipt" function, as available, return email 
                    or other form of written acknowledgment.</p>
    
            <div class="notice-group">
                <label for="consultant_rep_name">Consultant's Authorized Representative:</label>
                <input type="text" id="consultant_rep_name" name="consultant_rep_name" placeholder="Insert Name" required>
                <input type="email" id="consultant_rep_email" name="consultant_rep_email" placeholder="Insert Email Address" required>
            </div>

            <div class="notice-group">
                <label for="client_rep_name">Client's Authorized Representative:</label>
                <input type="text" id="client_rep_name" name="client_rep_name" placeholder="Insert Name" required>
                <input type="email" id="client_rep_email" name="client_rep_email" placeholder="Insert Email Address" required>
            </div>
        </div>

        <div class="form-group">
            <h4>15. AMENDMENT AND MODIFICATION.</h4>
            <p>
            These Terms may only be amended or modified by Agreement of the parties in a writing stating specifically 
            that it amends these Terms and is signed by an authorized representative of each party. The Consultant 
            shall be entitled to rely upon any communication received from the Client's Authorized Representative 
            which purports to request additional services not included in this Agreement or amend any Purchase 
            Order which has previously been received by the Consultant without the need for a formal change 
            order to be executed.
            </p>
        </div>

        <div class="form-group">
            <h4>16. WAIVER.</h4>
            <p>
            No waiver by the Consultant of any of the provisions of this Agreement is effective unless explicitly 
            set forth in writing and signed by the Consultant. No failure to exercise, or delay in exercising, 
            any right, remedy, power, or privilege arising from this Agreement operates, or may be construed, 
            as a waiver thereof. No single or partial exercise of any right, remedy, power, or privilege 
            hereunder precludes any other or further exercise thereof or the exercise of any other right, 
            remedy, power, or privilege.
            </p>
        </div>

        <div class="form-group">
            <h4>17. GOVERNING LAW.</h4>
            <p>This Agreement shall be governed under the laws in the Province of Alberta.</p>
        </div>

        <div class="form-group">
            <h4>18. EXCLUSIVE DISPUTE RESOLUTION MECHANISM</h4>
            <p>
                The parties shall resolve any dispute, controversy, disagreement, or claim arising out of, 
                relating to or in connection with this Agreement, or the breach, termination, existence, 
                or invalidity hereof (each, a "Dispute"). The procedures set forth in this section 18 
                shall be the exclusive mechanism for resolving any Dispute that may arise from time to time.
            </p>
            <p>
                A party shall send written notice to the other party of any Dispute ("Dispute Notice"). The 
                parties shall first attempt in good faith to resolve any Dispute set forth in the Dispute 
                Notice by negotiation and consultation between themselves, including without limitation not 
                fewer than three (3) negotiation sessions which must be held within 60 days of the date the 
                Dispute Notice was delivered to the other party. For greater clarity, should the parties 
                resolve the Dispute within the first or second negotiation session, they shall not be required 
                to attend a second or third, as the case may be, negotiation session.
            </p>
            <p>
                In the event that such Dispute is not resolved on an informal basis during the negotiation 
                sessions, either party may initiate arbitration by sending written notice to the other party 
                (the “Arbitration Notice”). The following provisions shall govern any arbitration hereunder:
            </p>
            <ol style="list-style-type: lower-alpha;">
                <li>The legal seat of arbitration shall be Lethbridge, Alberta.</li>
                <li>There shall be one arbitrator agreed to by the parties within twenty (20) days 
                    of receipt by the respondent of the Arbitration Notice. Should the Parties be 
                    unable to agree on a single arbitrator, each party shall appoint an arbitrator 
                    within twenty (20) days of receipt by the respondent of the Arbitration Notice 
                    and the two (2) arbitrators appointed by the parties shall appoint a third arbitrator, 
                    presiding, arbitrator within fourteen (14) days of the appointment of the second arbitrator.</li>
                <li>Any decision of the arbitrator(s)/two of the three arbitrators shall be final and binding 
                    on the Parties and their respective successors and assigns and there shall be no right to 
                    appeal such decision, whether on a question of law, a question of fact, or a mixed question 
                    of fact and law.</li>
                <li>The arbitration procedures, hearings, documents, and award shall remain strictly confidential 
                    between the parties.</li>
            </ol>
        </div>
        
        <div class="form-group">
            <h4>19. SEVERABILITY.</h4>
            <p>
                This Agreement shall remain in effect in the event a section or provision is unenforceable or invalid. 
                All remaining sections and provisions shall be deemed legally binding unless a court administers 
                that any such provision or section is invalid or unenforceable, thus, limiting the effect of another 
                provision or section. In such case, the affected provision or section shall be enforced as so limited.
            </p>
        </div>

        <div class="form-group">
            <h4>20. ADDITIONAL TERMS & CONDITIONS</h4>
            <textarea name="additional_terms" rows="6" style="width: 100%;" placeholder="Enter any additional terms and conditions here."></textarea>
        </div>

        <div class="form-group">
            <h4>21. ENTIRE AGREEMENT</h4>
            <p>This Agreement, along with any attachments or addendums, represents the entire agreement between the parties. Therefore, this Agreement supersedes any prior agreements, promises, conditions, or understandings between the Client and Consultant. This Agreement may be modified or amended if the amendment is made in writing and is signed by both parties.</p>
            
            <p>IN WITNESS WHEREOF, the Parties hereto have executed this Agreement on the dates written hereunder.</p>

            <div class="signature-group" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                <div style="flex-grow: 1; margin-right: 10px;">
                    <label for="consultant_signature">Consultant's Signature:</label>
                    <input type="text" id="consultant_signature" name="consultant_signature" style="width: 62%;">
                </div>
                <div>
                    <label for="consultant_date">Date:</label>
                    <input type="date" id="consultant_date" name="consultant_date">
                </div>
            </div>
            <div class="signature-group" style="display: flex; align-items: center; justify-content: space-between;">
                <div style="flex-grow: 1; margin-right: 20px;">
                    <label for="consultant_print_name">Print Name:</label>
                    <input type="text" id="consultant_print_name" name="consultant_print_name" style="width: 60%;">
                </div>
            </div>

            <div class="signature-group" style="display: flex; align-items: center; justify-content: space-between; margin-top: 10px; margin-bottom: 10px;">
                <div style="flex-grow: 1; margin-right: 10px;">
                    <label for="client_signature">Client's Signature:</label>
                    <input type="text" id="client_signature" name="client_signature" style="width: 66%;">
                </div>
                <div>
                    <label for="client_date">Date:</label>
                    <input type="date" id="client_date" name="client_date">
                </div>
            </div>
            <div class="signature-group" style="display: flex; align-items: center; justify-content: space-between;">
                <div style="flex-grow: 1; margin-right: 20px;">
                    <label for="client_print_name">Print Name:</label>
                    <input type="text" id="client_print_name" name="client_print_name" style="width: 60%;">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3>Schedule “A” - Services</h3>
            <p>(Client to initial the description for each service accepted under this agreement)</p>

            <table class="table table-bordered" style="width: 100%; table-layout: fixed;">
                <colgroup>
                    <col style="width: 25%;">
                    <col style="width: 15%;">
                    <col style="width: 60%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Check</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Supply Chain Management</td>
                        <td><input type="checkbox" name="service_supply_chain_management"></td>
                        <td><input type="text" name="description_supply_chain_management" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Strategic Sourcing & Procurement</td>
                        <td><input type="checkbox" name="service_strategic_sourcing_procurement"></td>
                        <td><input type="text" name="description_strategic_sourcing_procurement" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Custom Private & Client Branding / Private Label</td>
                        <td><input type="checkbox" name="service_custom_private_label"></td>
                        <td><input type="text" name="description_custom_private_label" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Import Service</td>
                        <td><input type="checkbox" name="service_import"></td>
                        <td><input type="text" name="description_import" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>3rd Party Logistics</td>
                        <td><input type="checkbox" name="service_3pl"></td>
                        <td><input type="text" name="description_3pl" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Quality Assurance</td>
                        <td><input type="checkbox" name="service_quality_assurance"></td>
                        <td><input type="text" name="description_quality_assurance" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Design Services</td>
                        <td><input type="checkbox" name="service_design_services"></td>
                        <td><input type="text" name="description_design_services" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Warehousing</td>
                        <td><input type="checkbox" name="service_warehousing"></td>
                        <td><input type="text" name="description_warehousing" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Distribution</td>
                        <td><input type="checkbox" name="service_distribution"></td>
                        <td><input type="text" name="description_distribution" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <h3>Schedule "B" - Form of Purchase Order</h3>
        </div>


            <button type="submit" class="btn btn-primary">Submit Agreement</button>
        </form>
    </div>
</x-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enable/disable date input based on term end selection
    document.querySelectorAll('input[name="term_end"]').forEach((input) => {
        input.addEventListener('change', function() {
            document.querySelector('input[name="end_date"]').disabled = this.value !== 'date';
            document.querySelector('input[name="other_end"]').disabled = this.value !== 'other';
        });
    });
});
</script>


<style>
.notice-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.notice-group label {
    flex-basis: 220px;
    margin-right: 10px;
}

.notice-group input[type="text"],
.notice-group input[type="email"] {
    flex: 1;
}

.table {
        width: 100%;
        border-collapse: collapse;
    }
    .table, .table th, .table td {
        border: 1px solid black;
    }
    .table th, .table td {
        text-align: left;
        padding: 8px;
    }
    .table th {
        background-color: #f2f2f2;
    }
    .table td {
        vertical-align: middle; 
    }
    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    input[type="checkbox"] {
        margin-right: 10px;
    }
</style>